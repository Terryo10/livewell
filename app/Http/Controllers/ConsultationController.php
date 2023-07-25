<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationBooked;
use App\Models\BookingFee;
use App\Models\BookingOrders;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function index()
    {
        // $token = $this->gateway()->ClientToken()->generate();
        $total = BookingFee::all()->first()->booking_fee;
        return view('consultation')->with(['token' => '', 'total' => $total]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'date' => 'required',
            'phone' => 'required',
        ]);

        return  $this->createPaynowPayment("10", "consultation", $request);
    }
}
