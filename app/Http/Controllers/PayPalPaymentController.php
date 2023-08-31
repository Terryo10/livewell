<?php

namespace App\Http\Controllers;

use Exception;
use Srmklive\PayPal\Services\ExpressCheckout;

use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Consultation;
use App\Models\BookingOrders;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\BookingFee;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultationBooked;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Deliveries;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\TemporaryAddress;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class PayPalPaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $price = Pricing::all();
        $user = Auth::user();
        try {
            if ($request->input('consultation')) {
                $this->validate($request, [
                    'message' => 'required',
                    'date' => 'required',
                    'phone' => 'required',
                ]);
                $consultation = new Consultation();
                $consultation->user_id = auth()->user()->id;
                $consultation->message = $request->message;
                $consultation->date = $request->date;
                $consultation->phone = $request->phone;
                $consultation->save();

                $order = new Order();
                $order->user_id = Auth::id();
                $order->delivery_id = $consultation->id;
                $order->paymentStatus = "pending";
                $order->status = 'ordered';
                $order->transaction_id = 0;
                $order->save();

                $user = auth()->user();
                $mailData = [
                    'title' => 'Consultation Booked',
                    'body' => 'Your consultation has been booked successfully. We will get back to you shortly. any questions? contact us at +27 72 154 7121 '
                ];
                Mail::to($user->email)->send(new ConsultationBooked($mailData));
                $bookingFees = BookingFee::all();
                $bookingFee = $bookingFees[0]->booking_fee;
                return $this->createPaynowPayment($bookingFee, "consultation", $order->id, "paypal");
            } elseif ($request->checkout) {
                $price = $request->total;
                $temporaryAddress = auth::user()->temporaryAddress;


                if ($temporaryAddress == !null) {

                    $total = $this->totalweb();
                    $cart = Auth::user()->cart;
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
                    $delivery->transaction_ref = '';
                    $delivery->country = $temporaryAddress->country;
                    $delivery->save();

                    //begin orders
                    $order = new Order();
                    $order->user_id = Auth::id();
                    $order->delivery_id = $delivery->id;
                    $order->paymentStatus = "pending";
                    $order->status = 'ordered';
                    $order->transaction_id = 0;
                    $order->save();

                    $orderSaved = $order;
                    $order_items = $cart->cart_items;
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
                        //Subtract quantity
                        $product = Products::where('id', $item->product->id)->first();
                        $productOriginalQuantity = $product->stock;
                        // dd($productOriginalQuantity);//we were using quantity instead stock field inside the database
                        $product->update([
                            'stock' => ($productOriginalQuantity - $item->quantity),
                        ]);
                    }
                    $cart->delete();
                    return $this->createPaynowPayment($total, "checkout", $order->id, "paypal");
                }
            } elseif ($request->subscription) {
                $order = new Order();
                $order->user_id = Auth::id();
                $order->delivery_id = 3;
                $order->paymentStatus = "pending";
                $order->status = 'ordered';
                $order->transaction_id = 0;
                $order->save();
                return $this->createPaynowPayment($price[0]->price, "subscription", $order->id, "paypal");
            } elseif ($request->input('order')) {
                if ($request->tran_id !== null) {
                    return $this->createPaynowPayment($request->total, "payagain", $request->tran_id, "paypal");
                }
            }
        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('message', $th->getMessage());
        }
    }



    public function paymentCancel()

    {
        return redirect('/home')->with("message", "Your payment has been declend. The payment cancelation page goes here!");
    }



    public function paymentSuccess(Request $request, $id = "")

    {
        $user = Auth::user();
        $order_get = Order::where('id', $id)->first();
        if ($order_get) {
            $transaction_top = Transaction::where('id', $order_get->transaction_id)->first();
        } else {
            $transaction_top = Transaction::where('id', $id)->first();
        }
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->paypal()->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                // $payment = new Payment;
                // $payment->payment_id = $arr_body['id'];
                // $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                // $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                // $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                // $payment->currency = env('PAYPAL_CURRENCY');
                // $payment->payment_status = $arr_body['state'];
                // $payment->save();
                $transaction_top->update(['is_used' => true, 'status' => $arr_body['state'] === "approved" ? "paid" : "pending"]);
                if ($order_get) {
                    $order_get->update(['paymentStatus' => 'paid']);
                }

                if ($transaction_top->type == "subscription") {
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
                } elseif ($transaction_top->type == "checkout") {
                    if ($order_get) {
                        $order_get->update(['paymentStatus' => $arr_body['state'] === "approved" ? "paid" : "pending"]);
                    }
                }
                return redirect('/home')->with('message', "Payment is successful. Your transaction id is: " . $arr_body['id']);
            } else {
                return redirect('/home')->withErrors('message', $response->getMessage());
            }
        } else {
            return redirect('/home')->withErrors('message', "Payment was declined please try again");
        }
    }
}
