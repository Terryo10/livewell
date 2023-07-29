<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Deliveries;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\TemporaryAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user = auth::user();

        //check if user has cart
        if ($user->cart !== null) {
            $total = $this->totalweb();
            $cart = Cart::find($user->cart->id);
            $cart_items = $cart->cart_items;
            //return $total;
            //return $cart_items;
            return view('cart.cart')
                ->with('cart_items', $cart_items)
                ->with('total', $total);
        }
        return view('cart.cart')->with('cart_items', null)
            ->with('total', 0);
    }
    public function shippingChange($id)
    {
        $shipping = temporaryAddress::find($id);
        $shipping->delete();

        return redirect('/shipping_details')
            ->with('success', 'Change your address here');
    }

    public function shippingStore(Request $request)
    {
        $temporaryAddress = auth::user()->temporaryAddress;
        if ($temporaryAddress == !null) {
        } else {
            $id = auth::user()->id;
            $temporary = new TemporaryAddress();
            $temporary->user_id = $id;
            $temporary->firstname = $request->input('firstname');
            $temporary->lastname = $request->input('lastname');
            $temporary->state = $request->input('state');
            $temporary->zip = $request->input('zip');
            $temporary->company = $request->input('company');
            $temporary->phone = $request->input('phone');
            $temporary->city = $request->input('city');
            $temporary->country = $request->input('country');
            $temporary->address = $request->input('address');
            $temporary->email = auth::user()->email;
            $temporary->save();

            return redirect('/shipping_details')->with('success', 'Address Set');
        }
    }

    public function visapay(Request $request)
    {
        if($request->tran_id !== null){
            return $this->createPaynowPayment($request->total, "payagain", $request->tran_id);

        }else{
        $temporaryAddress = auth::user()->temporaryAddress;


        if ($temporaryAddress == !null) {

            $total = $this->totalweb();
            $cart = Auth::user()->cart;
            // dd($transaction);
            $temporaryAddress = Auth::user()->temporaryAddress;
            $delivery = new Deliveries();
            $delivery->user_id = Auth::id();
            $delivery->address = $temporaryAddress->address;
            $delivery->company = $temporaryAddress->company;
            $delivery->phone = $temporaryAddress->phone;
            $delivery->firstname = $temporaryAddress->firstname;
            $delivery->lastname = $temporaryAddress->lastname;
            $delivery->city = $temporaryAddress->city;
            $delivery->state = $temporaryAddress->state;
            $delivery->transaction_ref = '';
            $delivery->country = $temporaryAddress->country;
            $delivery->save();

            //begin orders
            $order = new Order();
            $order->user_id = Auth::id();
            $order->delivery_id = $delivery->id;
            $order->paymentStatus = "pending";
            $order->status = 'ordered';
            $order->transaction_id = 0;
            $order->save();

            $orderSaved = $order;
            $order_items = $cart->cart_items;
            foreach ($order_items as $item) {
                $order_item = new OrderItems();
                $order_item->quantity = $item->quantity;
                $order_item->status = 'ordered';
                $order_item->price = $item->product['price'];
                $order_item->product_id = $item->product_id;
                $order_item->orders_id = $orderSaved->id;
                $order_item->save();
            }

            foreach ($order_items as $item) {
                //Subtract quantity
                $product = Products::where('id',$item->product->id)->first();
                $productOriginalQuantity = $product->stock;
                 dd($productOriginalQuantity);//we were using quantity instead stock field inside the database
                $product->update([
                    'stock' => ($productOriginalQuantity - $item->quantity),
                ]);
            }
            $cart->delete();
            return $this->createPaynowPayment($total, "checkout", $order->id);
        } else {
            return redirect('/shipping_details')->with('error', 'You dont have a shipping addresss');
        }
    }
        //check if user has a temporary address
        //token pass
        // pass price
        // pass designated address


    }

    public function shipping()
    {
        $temporaryAddress = Auth::user()->temporaryAddress;
        return view('shipping')
            ->with('temporaryAddress', $temporaryAddress);
    }

    public function checkoutBraintree(Request $request)
    {
        $total = $this->totalweb();
        $user = Auth::user();
        $gateway = $this->gateway();
        $amount = $total;
        $nonce = $request->payment_method_nonce;

        if ($user->cart == null) {
            return redirect('/cart');
        }
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            $cart = $user->cart;
            // dd($transaction);
            $temporaryAddress = Auth::user()->temporaryAddress;
            $delivery = new Deliveries();
            $delivery->user_id = Auth::id();
            $delivery->address = $temporaryAddress->address;
            $delivery->company = $temporaryAddress->company;
            $delivery->phone = $temporaryAddress->phone;
            $delivery->firstname = $temporaryAddress->firstname;
            $delivery->lastname = $temporaryAddress->lastname;
            $delivery->city = $temporaryAddress->city;
            $delivery->state = $temporaryAddress->state;
            $delivery->transaction_ref = $transaction->id;
            $delivery->country = $temporaryAddress->country;
            $delivery->save();
            $fetchdelivery = Deliveries::where('transaction_ref', $transaction->id)->first();

            //begin orders
            $order = new Order();
            $order->user_id = Auth::id();
            $order->delivery_id = $fetchdelivery->id;
            $order->transaction_ref = $transaction->id;
            $order->paymentStatus = $transaction->status;
            $order->status = 'ordered';
            $order->transaction_id = $transaction->id;
            $order->save();

            $orderSaved = $order;
            $order_items = $user->cart->cart_items;
            foreach ($order_items as $item) {
                $order_item = new OrderItems();
                $order_item->quantity = $item->quantity;
                $order_item->status = 'ordered';
                $order_item->price = $item->product['price'];
                $order_item->product_id = $item->product_id;
                $order_item->orders_id = $orderSaved->id;
                $order_item->save();
            }

            foreach ($order_items as $item) {
                $productOriginalQuantity = $item->product->quantity;
                //Subtract quantity
                $product = Products::findOrFail($item->product->id);
                $product->update([
                    'stock' => $productOriginalQuantity - $item->quantity,
                ]);
            }

            $cart->delete();
            return redirect('/home')->with('success', 'Transaction Successful: The Transaction Reference is' . $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('An Error Occurred', $result->message);
        }
    }

    public function saveCartWeb(Request $request)
    {
        $this->validate($request, [

            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'


        ]);
        $user = Auth::user();
        if ($user->cart !== null) {
            $cart = cart::find($user->cart->id);
        } else {
            $cart = new cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Products::find($request->input('product_id'));

        if ($request->input('quantity') > $product->stock) {
            return redirect()->back()->WithErrors(['message' => "The maximum purchasable items are {$product->stock}"]);
        } else {

            if ($cart_item = $this->checkProductInCart($product->id, $cart->cart_items)) {
                $cart_item = CartItems::find($cart_item->id);
                $cart_item->quantity = $cart_item->quantity + $request->input('quantity');
                $cart_item->save();
            } else {
                $cart_item = new CartItems();
                $cart_item->quantity = $request->input('quantity');
                $cart_item->product_id = $request->input('product_id');
                $cart_item->price = $product->price;
                $cart_item->cart_id = $cart->id;
            }

            $cart_item->save();
            return redirect()->back()->with('message', "Product {$product->name} added to cart successfully");
        }
    }

    public function checkProductInCart($product_id, $cart_items)
    {
        foreach ($cart_items as $item) {
            if ($product_id == $item->product_id) {
                return $item;
            }
        }
    }

    public function deleteCartItem(Request $request)
    {
        $this->validate($request, [

            'cart_item_id' => 'required',


        ]);
        $user = Auth::user();

        $cart_item = CartItems::find($request->input('cart_item_id'));
        if ($cart_item != null) {
            $cart_item->delete();
            return redirect()->back()->with('message', 'item removed Succesfully');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete',
            ]);
        }
    }
}
