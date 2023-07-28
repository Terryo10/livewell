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
        try {
            $this->createPaynowPayment($price[0]->price, "subscription",$user->subscribed->id);
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
