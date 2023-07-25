<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Paynow\Payments\Paynow;
use App\Models\Consultation;
use App\Models\BookingFee;
use App\Models\Transaction;
use App\Models\BookingOrders;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultationBooked;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Deliveries;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getBraintreeToken()
    {
        // $clientToken = $this->gateway()->clientToken()->generate();
        $clientToken = "";

        return $clientToken;
    }
    public function paynow($id = "", $type = "", $request)
    {
        $site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $request_url = $_SERVER['REQUEST_URI'];
        return new Paynow(
            env('PAYNOW_INTERGRATION_ID'),
            env('PAYNOW_INTERGRATION_KEY'),
            // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
            "$site_url/confirm-payment/$id/$type/$request",//return url
            "$site_url/confirm-payment/$id/$type/$request",//result url
        );
    }

    public function gateway()
    {
        return  new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'd7y56nytpfv9zvpf',
            'publicKey' => 'qhb6sfyz8sgwb5b3',
            'privateKey' => '79dfe782ff54aa7788d7786a8143880c'
        ]);
    }

    public function totalweb()
    {
        $user = Auth::user();
        if ($user !== null) {
            if ($user->cart !== null) {
                $cart_items = $user->cart->cart_items;
                if (!$cart_items) {
                    return $total = 0;
                } else {
                    $total = 0;
                    foreach ($cart_items as $item) {
                        $total = $total + ($item->quantity * $item->price);
                    }
                    return $total;
                }
            }
            return $total = 0;
        }
        // dd($user);

    }


    private function generateRandomId(): string
    {
        $random_data = "1234567890jefhbeyeaihiuhneiunwurbhihnoahuhrihw";
        return uniqid($random_data);
    }

    public function createPaynowPayment($price = 0, $type = "", $request)
    {

        try {
            $user = Auth::user();
            $tran = new Transaction();
            $tran->status = false;
            $tran->amount = $price;
            $tran->currency = "USD";
            $tran->payment_method = "PAYNOW";
            $tran->poll_url = "";
            $tran->user_id = $user->id;
            $tran->type = $type;
            $tran->subscription_id = $user->subscribed->id;
            $tran->save();
            $id = $tran->id;
            $uuid = $this->generateRandomId();
            $payment = $this->paynow($id, $type, $request)->createPayment("$uuid", $user->email ?? $request->name);
            $payment->add("$type $user->name??$request->name", $price);
            $response = $this->paynow($id, $type, $request)->send($payment);
            if ($response->success) {
                $tran->update(['poll_url' => $response->pollUrl()]);//update poll_url before redirecting the user to redirect url
                $link = $response->redirectUrl();

                return redirect()->to($link);
            } else {

                return redirect()->back()->WithErrors(['message' => 'Oops something went wrong while trying to proccess your transaction please try again']);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    public function checkPollUrlAndUpdateDatabase($type = "", $request, $id = "")
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $id)->get()->first();
        $response = $this->paynow($id, $type, $request)->pollTransaction($transaction->poll_url);
        $price = $transaction->amount;
        $poll_url = $transaction->poll_url;

        if ($response->paid()) {
            if ($type == 'transaction') {
                $tran = new Transaction();
                $tran->status = $response->paid();
                $tran->amount = $price;
                $tran->currency = "USD";
                $tran->payment_method = "PAYNOW";
                $tran->poll_url = $poll_url;
                $tran->user_id = $user->id;
                $tran->type = $type;
                $tran->subscription_id = $user->subscribed->id;
                $tran->save();
                $transaction->update(['is_used' => true]);
            } else if ($type == 'consultation') {
                $consultation = new Consultation();
                $consultation->user_id = auth()->user()->id;
                $consultation->message = $request->message;
                $consultation->date = $request->date;
                $consultation->phone = $request->phone;
                $consultation->save();

                $booking_order = new BookingOrders();
                $booking_order->user_id = auth()->user()->id;
                $booking_order->booking_fee = BookingFee::all()->first()->booking_fee;
                $booking_order->transaction_ref = $this->generateRandomId();
                $booking_order->consultation_id = $consultation->id;
                $booking_order->save();

                //send email to authenticated user
                $user = auth()->user();
                $mailData = [
                    'title' => 'Consultation Booked',
                    'body' => 'Your consultation has been booked successfully. We will get back to you shortly. any questions? contact us at +27 72 154 7121 '
                ];
                Mail::to($user->email)->send(new ConsultationBooked($mailData));

                return redirect()->route('home')
                    ->with('success', 'Payment successful. Your transaction ID is: ' . $this->generateRandomId());
            } else if ($type == 'checkout') {
                //do the checkout process
                $transaction = $this->generateRandomId();
                $cart = $user->cart;
                // dd($transaction);
                $temporaryAddress = Auth::user()->temporaryAddress;
                $delivery = new Deliveries();
                $delivery->user_id = Auth::id();
                $delivery->address = $temporaryAddress->address;
                $delivery->company = $temporaryAddress->company;
                $delivery->phone = $temporaryAddress->phone;
                $delivery->firstname = $temporaryAddress->firstname;
                $delivery->lastname = $temporaryAddress->lastname;
                $delivery->city = $temporaryAddress->city;
                $delivery->state = $temporaryAddress->state;
                $delivery->transaction_ref = $transaction;
                $delivery->country = $temporaryAddress->country;
                $delivery->save();
                $fetchdelivery = Deliveries::where('transaction_ref', $transaction)->first();

                //begin orders
                $order = new Order();
                $order->user_id = Auth::id();
                $order->delivery_id = $fetchdelivery->id;
                $order->transaction_ref = $transaction;
                $order->paymentStatus = $transaction;
                $order->status = 'ordered';
                $order->save();

                $orderSaved = $order;
                $order_items = $user->cart->cart_items;
                foreach ($order_items as $item) {
                    $order_item = new OrderItems();
                    $order_item->quantity = $item->quantity;
                    $order_item->status = 'ordered';
                    $order_item->price = $item->product['price'];
                    $order_item->product_id = $item->product_id;
                    $order_item->orders_id = $orderSaved->id;
                    $order_item->save();
                }

                foreach ($order_items as $item) {
                    $productOriginalQuantity = $item->product->quantity;
                    //Subtract quantity
                    $product = Products::findOrFail($item->product->id);
                    $product->update([
                        'stock' => $productOriginalQuantity - $item->quantity,
                    ]);
                }

                $cart->delete();
                return redirect('/home')->with('success', 'Transaction Successful: The Transaction Reference is' . $transaction);
                //end of checkout processing
            } else {
                //if antother type do default
                $transaction = Transaction::where('user_id', Auth::user()->id)->get()->first();
                $status = $this->paynow($id, $type, $request)->pollTransaction($transaction->poll_url);
                if ($status->paid()) {
                    if (!$transaction->is_used) {
                        $subscription = Auth::user()->subscribed;
                        if ($subscription->expires_at > Carbon::now()) {
                            //add 30 days on top of user subscription
                            $subscription->expires_at = $subscription->expires_at->addDays(30);
                        } else {
                            //add 30 days only
                            $subscription->expires_at =  Carbon::now()->addDays(30);
                        }
                        $subscription->update();
                        $transaction->update(['is_used' => true]);
                        return redirect('payment-success')->with('message', 'Payment Success');
                    }
                } else {
                    return redirect('home')->with('message', 'Payment was not made!!!!');
                }
            }
        }
    }
}
