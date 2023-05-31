<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SubscriptionPayment extends Component
{

    public $token;
    public $pricing;
    public function render()
    {
        return view('livewire.subscription-payment',
         [
            'token' => $this->token, 
            'pricing' => $this->pricing
        ]);
    }
}
