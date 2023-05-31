<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function getBraintreeToken()
    {
        return parent::getBraintreeToken();
    }

    public function checkoutSubscription(Request $request)
    {

    }

    public function makePayment(Request $request)
    {

        $data = $request->validate([
            'payment_method_nonce' => 'required',
        ]);

        $nonceFromTheClient = $data['payment_method_nonce'];
        $price = Pricing::all();
        $user = Auth::user();
        try {
            $response = $this->gateway()->transaction()->sale([
                'amount' => $price[0]->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            if ($response->success) {
                $tran = new Transaction();
                $tran->reference = $response->transaction->id;
                $tran->status = $response->transaction->status;
                $tran->amount = $response->transaction->amount;
                $tran->currency = $response->transaction->currencyIsoCode;
                $tran->payment_method = $response->transaction->paymentInstrumentType;
                $tran->status_url = $response->transaction->type;
                $tran->user_id = $user->id;
                $tran->subscription_id = $user->subscribed->id;
                $tran->save();
                //create or update subscription
                $subscription = Auth::user()->subscribed;
                if($subscription->expires_at > Carbon::now()){
                    //add 30 days on top of user subscription
                    $subscription->expires_at = $subscription->expires_at->addDays(30);
                }else{
                     //add 30 days only
                     $subscription->expires_at =  Carbon::now()->addDays(30);
                }
                $subscription->update();
                return redirect('payment-success')->with('message', 'Subscription was made Successfully');
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
