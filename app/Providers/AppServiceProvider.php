<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $user = Auth::user();
            if ($user !== null) {
                $cartglobal = $user->cart;
            } else {
                $cartglobal = [];
            }

            if ($user !== null) {
                if ($cartglobal !== null) {
                    $cartitemsglobal = $cartglobal->cart_items;
                } else {
                    $cartitemsglobal = [];
                }
            } else {
                $cartitemsglobal = [];
            }

            $totalwebglobal = $this->totalwebglobal();
            $categoryese = Categories::all();
            $quantity = 0;

            if ($user !== null) {
                if ($user->cart !== null) {
                    $cart = Cart::find($user->cart->id);
                    // $count = $cart->cart_items->count();
                    foreach ($cart->cart_items as $item) {
                        $quantity += $item->quantity;
                    }
                } else {
                    $quantity = 0;
                }
            }

            $view->with('quantity', $quantity)
                ->with('categoryese', $categoryese)
                ->with('cartItemsGlobal', $cartitemsglobal)
                ->with('totalwebglobal', $totalwebglobal);
        });
    }

    public function totalwebglobal()
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

    }
}
