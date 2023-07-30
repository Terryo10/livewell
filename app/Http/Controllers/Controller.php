<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
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
    public function paynow($id = "", $type = "")
    {
        $site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $request_url = $_SERVER['REQUEST_URI'];
        return new Paynow(
            env('PAYNOW_INTERGRATION_ID'),
            env('PAYNOW_INTERGRATION_KEY'),
            // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
            "$site_url/confirm-payment/$id",//return url
            "$site_url/confirm-payment/$id",//result url
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

    public function createPaynowPayment($price = 0, $type = "", $typeId)
    {

        try {

            //new transaction
            if(!Auth::user()->subscribed){
                $newSubscription = new Subscriptions();
                $newSubscription->user_id = Auth::user()->id;
                $newSubscription->save();
            }
           if($type == "payagain"){
            $id = $typeId;
            $uuid = $this->generateRandomId();
            $payment = $this->paynow($id, $type)->createPayment("$uuid", "");
            $payment->add("$type", $price);
            $response = $this->paynow($id, $type)->send($payment);

            if ($response->success) {
                $update_tran = Transaction::find($id);
                $update_tran->update(['poll_url'=>$response->pollUrl()]);

                $link = $response->redirectUrl();
                return redirect()->to($link);
            } else {
                return redirect()->back()->WithErrors(['message' => 'Oops something went wrong while trying to proccess your transaction please try again']);
            }

           }else{
            $user = Auth::user();
            $tran = new Transaction();
            $tran->amount = $price;
            $tran->currency = "USD";
            $tran->payment_method = "PAYNOW";
            $tran->poll_url = "";
            $tran->user_id = $user->id;
            $tran->type = $type;
            $tran->subscription_id = $user->subscribed->id;
            $tran->save();
            $transaction_update = Order::findorFail($typeId)->update(['transaction_id' => $tran->id]);

            if($type == 'consultation'){
                $booking_order = new BookingOrders();
                $booking_order->user_id = auth()->user()->id;
                $booking_order->booking_fee = BookingFee::all()->first()->booking_fee;
                $booking_order->transaction_ref = $tran->id;
                $booking_order->transaction_id = $tran->id;
                $booking_order->consultation_id = $typeId;
                $booking_order->save();
            }elseif($type == "checkout"){
                $transaction_update = Order::find($typeId)->update(['transaction_id' => $tran->id]);
                //update Order transaction_id to link it up with the transaction
            }

            $id = $tran->id;
            $uuid = $this->generateRandomId();
            $payment = $this->paynow($id, $type)->createPayment("$uuid", $user->email);
            $payment->add("$type", $price);
            $response = $this->paynow($id, $type)->send($payment);

            if ($response->success) {
                $update_tran = Transaction::find($tran->id);
                $update_tran->update([ 'poll_url' => $response->pollUrl(), 'order_id'=> $typeId]);
                if($type =="consultation"){
                    $tran->update(['poll_url' => $response->pollUrl()]);//update poll_url before redirecting the user to redirect url
                }elseif ($type == "checkout"){
                    $order = Order::find($typeId);
                    $order->update(['poll_url'=>$response->pollUrl(),'transaction_id' => $tran->id]);
                }elseif ($type == "subscription"){
                    $tran->update(['poll_url' => $response->pollUrl()]);
                }

                $link = $response->redirectUrl();
                return redirect()->to($link);
            } else {
                return redirect()->back()->WithErrors(['message' => 'Oops something went wrong while trying to proccess your transaction please try again']);
            }


        }
        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    public function checkPollUrlAndUpdateDatabase($id = "")
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $id)->get()->first();
        $response = $this->paynow($id)->pollTransaction($transaction->poll_url);
        $price = $transaction->amount;
        $poll_url = $transaction->poll_url;
        $type = $transaction->type;

        if ($response->paid()) {
            $transaction->update(['is_used' => true, 'status' => $response->paid()?"paid":"pending"]);

            return redirect('/home')->with('status', 'Transaction Successful: The Transaction Reference is' . $transaction);
        }else{
            return redirect('/home')->with('status', 'Transaction was not paid please try again');
        }
    }
}
