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
    private function generateRandomId(): string
    {
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
    public function checkPaynowConfirmation($id, $type, $request)
    {

        return $this->checkPollUrlAndUpdateDatabase($type, $request, $id);
    }

    public function makePayment(Request $request)
    {

        $price = Pricing::all();
        $user = Auth::user();
        $id_next = Transaction::latest()->first();
        $id_next_add = "";
        if ($id_next->id ?? null !== null) {
            $id_next_add = $id_next->id++; //l incremented this value for case we do not created any transaction so we make second id be the next id
        } else {
            $id_next_add = 1;
        }
        try {
            $uuid = $this->generateRandomId();
            $payment = $this->paynow($id_next_add, "subscription", $request)->createPayment("$uuid", $user->email);
            $payment->add("subscription $user->name", $price[0]->price);
            $response = $this->paynow($id_next_add, "subscription", $request)->send($payment);
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

                return redirect()->back()->WithErrors(['message' => 'Oops something went wrong while trying to proccess your transaction please try again']);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    public function paymentSuccess()
    {
        return view('payments.paymentSuccess');
    }
}
