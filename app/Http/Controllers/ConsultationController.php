<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationBooked;
use App\Models\BookingFee;
use App\Models\Consultation;
use App\Models\BookingOrders;
use App\Models\Order;
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
        $consultation = new Consultation();
        $consultation->user_id = auth()->user()->id;
        $consultation->message = $request->message;
        $consultation->date = $request->date;
        $consultation->phone = $request->phone;
        $consultation->save();

        $order = new Order();
        $order->user_id = \Auth::id();
        $order->delivery_id = $consultation->id;
        $order->paymentStatus = "pending";
        $order->status = 'ordered';
        $order->transaction_id = 0;
        $order->save();


        //send email to authenticated user
        $user = auth()->user();
        $mailData = [
            'title' => 'Consultation Booked',
            'body' => 'Your consultation has been booked successfully. We will get back to you shortly. any questions? contact us at +27 72 154 7121 '
        ];
        Mail::to($user->email)->send(new ConsultationBooked($mailData));

        $bookingFees = BookingFee::all();
        $bookingFee = $bookingFees[0]->booking_fee;

        return  $this->createPaynowPayment($bookingFee, "consultation", $order->id, "paynow");
    }
}
