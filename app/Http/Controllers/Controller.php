<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getBraintreeToken()
    {
        $clientToken = $this->gateway()->clientToken()->generate();

        return $clientToken;
    }

    public function gateway()
    {
        return  new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'd7y56nytpfv9zvpf',
            'publicKey' => 'qhb6sfyz8sgwb5b3',
            'privateKey' => '79dfe782ff54aa7788d7786a8143880c'
        ]);
    }
    
    public function totalweb()
    {
        $user = Auth::user();
        if ($user !== null) {
            if ($user->cart !== null) {
                $cart_items = $user->cart->cart_items;
                if (!$cart_items) {
                    return $total = 0;
                } else {
                    $total = 0;
                    foreach ($cart_items as $item) {
                        $total = $total + ($item->quantity * $item->price);
                    }
                    return $total;
                }
            }
            return $total = 0;
        }
        // dd($user);

    }
}
