<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ShopController;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Products::latest()->take(6)->get();
    return view('welcome')
        ->with('products', $products);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostsController::class, 'getPosts'])->name('posts');

Route::get('/post/{id}', [App\Http\Controllers\PostsController::class, 'post'])->name('post');

Route::get('/blogSearch', [App\Http\Controllers\PostsController::class, 'blogSearch'])->name('blogSearch');

Route::get('/blogCategory/{id}', [App\Http\Controllers\PostsController::class, 'blogCategory'])->name('blogCategory');

Route::get('subscriptions', [App\Http\Controllers\SubscriptionController::class, 'subscription'])->name('subscriptions');

Route::get('getBraintreeToken', [PaymentsController::class, 'getBraintreeToken'])->middleware('auth');

Route::post('subscription-checkout', [PaymentsController::class, 'makePayment'])->name('payment.make');

Route::get('confirm-payment/{id}', [PaymentsController::class, 'checkPaynowConfirmation']);

Route::get('payment-success', [PaymentsController::class, 'paymentSuccess']);

Route::get('shop', [ShopController::class, 'index']);

Route::get('shop/product/{id}', [ShopController::class, 'product']);

Route::get('shop/category/{id}', [ShopController::class, 'category']);

Route::get('/paypal_visa', [CartController::class, 'visapay'])->middleware('auth');

Route::post('/paynow_visa', [CartController::class, 'visapay'])->middleware('auth');

Route::get('/shipping_details', [CartController::class, 'shipping'])->middleware('auth');

Route::get('/shipping_change/{id}', [CartController::class, 'shippingChange'])->middleware('auth');

Route::post('/shipping/store', [CartController::class, 'shippingStore'])->name('shipping.store')->middleware('auth');

Route::get('cart', [CartController::class, 'index'])->name('cart')->middleware('auth');

Route::get('cart/delete', [CartController::class, 'deleteCartItem'])->middleware('auth');

Route::post('cart/save', [CartController::class, 'savecartweb'])->name('savetocart')->middleware('auth');

Route::post('/pay', [CartController::class, 'checkoutBraintree'])->name('pay.braintree')->middleware('auth');

Route::get('/consultation', [\App\Http\Controllers\ConsultationController::class, 'index'])->middleware('auth');

Route::post('/consultation/booking', [\App\Http\Controllers\ConsultationController::class, 'store'])->middleware('auth')->name('consultation.booking');
