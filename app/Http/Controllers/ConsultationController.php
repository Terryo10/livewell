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
    public function index(){
        $token = $this->gateway()->ClientToken()->generate();
        $total = BookingFee::all()->first()->booking_fee;
        return view('consultation')->with(['token'=>$token, 'total'=>$total]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'payment_method_nonce' => 'required',
            'message' => 'required',
            'date' => 'required',
            'phone' => 'required',
        ]);

        $nonce = $request->payment_method_nonce;
        $result = $this->gateway()->transaction()->sale([
            'amount' => BookingFee::all()->first()->booking_fee,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($result->success){
            $transaction = $result->transaction;
            $consultation = new Consultation();
            $consultation->user_id = auth()->user()->id;
            $consultation->message = $request->message;
            $consultation->date = $request->date;
            $consultation->phone = $request->phone;
            $consultation->save();

            $booking_order = new BookingOrders();
            $booking_order->user_id = auth()->user()->id;
            $booking_order->booking_fee = BookingFee::all()->first()->booking_fee;
            $booking_order->transaction_ref = $transaction->id;
            $booking_order->consultation_id = $consultation->id;
            $booking_order->save();

            //send email to authenticated user
            $user = auth()->user();
            $mailData = [
                'title' => 'Consultation Booked',
                'body' => 'Your consultation has been booked successfully. We will get back to you shortly. any questions? contact us at +27 72 154 7121 '
            ];
            Mail::to($user->email)->send(new ConsultationBooked($mailData));

            return redirect()->route('home')
                ->with('success', 'Payment successful. Your transaction ID is: '.$transaction->id);

        }else{
            $errorString = "";

            foreach($result->errors->deepAll() as $error){
                $errorString .= 'Error: '.$error->code.': '.$error->message."\n";
            }

            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }
}
