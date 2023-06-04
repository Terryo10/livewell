<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Pricing;

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
        $token = $this->getBraintreeToken();
        $orders = auth::user()->orders;
        return view('home')
            ->with('user',$user,)
            ->with('token', $token)
            ->with('pricing',$pricing[0])
            ->with('orders', $orders);
    }
}
