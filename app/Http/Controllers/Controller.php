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
use Exception;
use Omnipay\Omnipay;

class Controller extends BaseController
{
    public $site_url;
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    public function getBraintreeToken()
    {
        // $clientToken = $this->gateway()->clientToken()->generate();
        $clientToken = "";

        return $clientToken;
    }
    public function paynow($id = "", $type = "")
    {
        $site_url = $this->site_url;
        $request_url = $_SERVER['REQUEST_URI'];
        return new Paynow(
            env('PAYNOW_INTERGRATION_ID'),
            env('PAYNOW_INTERGRATION_KEY'),
            // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
            "$site_url/confirm-payment/$id", //return url
            "$site_url/confirm-payment/$id", //result url
        );
    }
    public function paypal()
    {
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(env('PAYPAL_Client_ID'));
        $gateway->setSecret(env('PAYPAL_SANDBOX_API_SECRET'));
        $gateway->setTestMode(true);
        return $gateway;
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

    public function createPaynowPayment($price = 0, $type = "", $typeId, $paymethMethod = "paynow")
    {
        $user = Auth::user();
        if ($paymethMethod === "paypal") {

            if ($type === "payagain") {
                $response = $this->paypal()->purchase(array(
                    'amount' => $price,
                    'items' => array(
                        array(
                            'name' => 'Order Retry Pay Fee',
                            'price' => $price,
                            'description' => 'Retry to pay using paypal.',
                            'quantity' => 1
                        ),
                    ),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => $this->site_url . "/success-payment/$typeId",
                    'cancelUrl' => $this->site_url . "/cancel-payment/$typeId",
                ))->send();

                if ($response->isRedirect()) {
                    return $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            }

            $tran = new Transaction();
            $tran->amount = $price;
            $tran->currency = "USD";
            $tran->payment_method = "PAYPAL";
            $tran->poll_url = "";
            $tran->user_id = $user->id;
            $tran->type = $type;
            $tran->subscription_id = $user->subscribed->id;
            $tran->save();
            $transaction_update = Order::where('id', $typeId)->first();
            if ($transaction_update) {
                $transaction_update->update(['transaction_id' => $tran->id]);
            }
            try {
                if ($type === "consultation") {

                    $response = $this->paypal()->purchase(array(
                        'amount' => $price,
                        'items' => array(
                            array(
                                'name' => 'Consultation Fee',
                                'price' => $price,
                                'description' => 'Get access to premium courses.',
                                'quantity' => 1
                            ),
                        ),
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => $this->site_url . "/success-payment/$typeId",
                        'cancelUrl' => $this->site_url . "/cancel-payment/$typeId",
                    ))->send();

                    if ($response->isRedirect()) {
                        return $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                } elseif ($type === "checkout") {
                    $response = $this->paypal()->purchase(array(
                        'amount' => $price,
                        'items' => array(
                            array(
                                'name' => 'Checkout Fee',
                                'price' => $price,
                                'description' => 'Get access to premium courses.',
                                'quantity' => 1
                            ),
                        ),
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => $this->site_url . "/success-payment/$typeId",
                        'cancelUrl' => $this->site_url . "/cancel-payment/$typeId",
                    ))->send();

                    if ($response->isRedirect()) {
                        return $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                } elseif ($type === 'subscription') {
                    Order::where('id', $typeId)->update(['transaction_id' => $tran->id]);
                    $response = $this->paypal()->purchase(array(
                        'amount' => $price,
                        'items' => array(
                            array(
                                'name' => 'Subscription Fee',
                                'price' => $price,
                                'description' => 'Get access to premium courses.',
                                'quantity' => 1
                            ),
                        ),
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => $this->site_url . "/success-payment/$typeId",
                        'cancelUrl' => $this->site_url . "/cancel-payment/$typeId",
                    ))->send();

                    if ($response->isRedirect()) {
                        return $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                }
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        } else {
            try {

                //new transaction
                if (!Auth::user()->subscribed) {
                    $newSubscription = new Subscriptions();
                    $newSubscription->user_id = Auth::user()->id;
                    $newSubscription->save();
                }
                if ($type == "payagain") {
                    $id = $typeId;
                    $uuid = $this->generateRandomId();
                    $payment = $this->paynow($id, $type)->createPayment("$uuid", "");
                    $payment->add("$type", $price);
                    $response = $this->paynow($id, $type)->send($payment);

                    if ($response->success) {
                        $update_tran = Transaction::find($id);
                        $update_tran->update(['poll_url' => $response->pollUrl()]);

                        $link = $response->redirectUrl();
                        return redirect()->to($link);
                    } else {
                        return redirect()->back()->WithErrors(['message' => 'Oops something went wrong while trying to proccess your transaction please try again']);
                    }
                } else {

                    $tran = new Transaction();
                    $tran->amount = $price;
                    $tran->currency = "USD";
                    $tran->payment_method = "PAYNOW";
                    $tran->poll_url = "";
                    $tran->user_id = $user->id;
                    $tran->type = $type;
                    $tran->subscription_id = $user->subscribed->id;
                    $tran->save();
                    $transaction_update = Order::findorFail($typeId)->first();
                    if ($transaction_update) {
                        $transaction_update->update(['transaction_id' => $tran->id]);
                    }

                    if ($type === 'consultation') {
                        $booking_order = new BookingOrders();
                        $booking_order->user_id = auth()->user()->id;
                        $booking_order->booking_fee = BookingFee::all()->first()->booking_fee;
                        $booking_order->transaction_ref = $tran->id;
                        $booking_order->transaction_id = $tran->id;
                        $booking_order->consultation_id = $typeId;
                        $booking_order->save();
                    } elseif ($type == "checkout") {
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
                        $update_tran->update(['poll_url' => $response->pollUrl(), 'order_id' => $typeId]);
                        if ($type == "consultation") {
                            $tran->update(['poll_url' => $response->pollUrl()]); //update poll_url before redirecting the user to redirect url
                        } elseif ($type == "checkout") {
                            $order = Order::find($typeId);
                            $order->update(['poll_url' => $response->pollUrl(), 'transaction_id' => $tran->id]);
                        } elseif ($type == "subscription") {
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
            $transaction->update(['is_used' => true, 'status' => $response->paid() ? "paid" : "pending"]);
            if ($transaction->type == "subscription") {
                //if exists add days not create new subscription
                $subscription = Auth::user()->subscribed;
                $date = Carbon::now();
                $date->addDays(31);
                // $date->format("Y-m-d");
                if ($subscription != null) {
                    if ($subscription->expires_at > Carbon::now()) {
                        //for current expires add another days
                        $new_date = $subscription->expires_at + $date;
                        $subscription->update(array('expires_at' => $new_date));
                    } else {
                        $new_date = $subscription->expires_at ? $date : $date;
                        $subscription->update(array('expires_at' => $new_date));
                        //add new subscription with days
                        // $newSubscription = new Subscriptions();
                        // $newSubscription->user_id = Auth::user()->id;
                        // $newSubscription->expires_at = $date;
                        // $newSubscription->save();
                    }
                }
            } elseif ($transaction->type  == "consultation") {
                try {
                    $account_email = "";
                    $consultation = Consultation::where('user_id', $user->id)->latest()->first();
                    $mailData = [
                        'title' => "Someone Booked Consultation On Date: $consultation->date ",
                        'body' => "Someone Booked Consultation On || Date: $consultation->date ||
                     Email: $user->email ||  Phone:  $consultation->phone
                     || Message: $consultation->message"
                    ];
                    Mail::to($account_email)->send(new ConsultationBooked($mailData));
                    return redirect('/home')->with('status', 'Consultation was sent successfully');
                } catch (Exception $error) {
                    return redirect()->back()->withErrors('message', 'Failed to send email to admin with an update');
                }
            }

            return redirect('/home')->with('status', 'Transaction Successful: The Transaction Reference is' . $transaction->id);
        } else {
            return redirect('/home')->with('status', 'Transaction was not paid please try again');
        }
    }
}
