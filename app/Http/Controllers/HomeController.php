<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Pricing;
use \App\Models\Order;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pricing = Pricing::all();
        $user=Auth::user();
        $booking = $user->bookings()->get();
        $token = $this->getBraintreeToken();
        $orders = auth::user()->orders;
        $order_transaction = Order::get();
        return view('home')
            ->with('user',$user,)
            ->with('token', $token)
            ->with('order_transaction', $order_transaction)
            ->with('pricing',$pricing[0])
            ->with('orders', $orders)
            ->with('booking',$booking);

    }
}
