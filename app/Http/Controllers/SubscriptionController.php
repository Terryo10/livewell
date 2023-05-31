<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Braintree\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subscription()
    {
        $subscription = Auth::user()->subscribed;
        if ($subscription != null) {
            if ($subscription->expires_at > Carbon::now()) {
                //redirect to blog page subscription is still valid
                return redirect()->back();
            } else {
                //navigate to home page so that he can renew their subscription
                return redirect()->route('home');
            }
        } else {
            //create a new subscription
            $newSubscription = new Subscriptions();
            $newSubscription->user_id = Auth::user()->id;
            $newSubscription->save();

            //navigate to homepage
            return redirect()->route('home');
        }
    }
}
