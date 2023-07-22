<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Dotenv\Util\Str;

class PaymentsController extends Controller
{
    private function generateRandomId(): string{
     $random_data = "1234567890jefhbeyeaihiuhneiunwurbhihnoahuhrihw";
     return uniqid($random_data);
    }

    public function getBraintreeToken()
    {
        return parent::getBraintreeToken();
    }

    public function checkoutSubscription(Request $request)
    {

    }
    public function checkPaynowConfirmation(){

        $transaction = Transaction::where('user_id', Auth::user()->id)->get()->first();
        $status = $this->paynow()->pollTransaction($transaction->poll_url);
        if($status->paid()){
        if(!$transaction->is_used){
            $subscription = Auth::user()->subscribed;
            if($subscription->expires_at > Carbon::now()){
                //add 30 days on top of user subscription
                $subscription->expires_at = $subscription->expires_at->addDays(30);
            }else{
                 //add 30 days only
                 $subscription->expires_at =  Carbon::now()->addDays(30);
            }
            $subscription->update();
            $transaction->update(['is_used'=> true]);
            return redirect('payment-success')->with('message', 'Payment Success');
        }

        }else{
           return redirect('home')->with('message', 'Payment was not made!!!!');
        }
    }

    public function makePayment(Request $request)
    {

        $price = Pricing::all();
        $user = Auth::user();
        try {
            $uuid = $this->generateRandomId();
            $payment = $this->paynow()->createPayment("$uuid", $user->email);
            $payment->add("subscription $user->name", $price[0]->price);
            $response = $this->paynow()->send($payment);
            if ($response->success) {
                $link = $response->redirectUrl();
                $tran = new Transaction();
                $tran->status = $response->status;
                $tran->amount = $price[0]->price;
                $tran->currency = "USD";
                $tran->payment_method = "PAYNOW";
                $tran->poll_url = $response->pollUrl();
                $tran->user_id = $user->id;
                $tran->subscription_id = $user->subscribed->id;
                $tran->save();
               return redirect()->to($link);
              } else {

                return redirect()->back()->WithErrors(['message'=>'Oops something went wrong while trying to proccess your transaction please try again']);
              }

        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('message', $th->getMessage());
        }

    }

    public function paymentSuccess(){
        return view('payments.paymentSuccess');
    }
}
