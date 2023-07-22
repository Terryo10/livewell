@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="uk-section uk-section-default">
        <div class="container">
            <div class="uk-grid-large" data-uk-grid>
                <div class="uk-width-expand@m">
                    <div class="uk-article">
                        <br>
                        <h3>{{ auth()->user()->name }}'s Shopping Cart</h3>
                        <div id="step-1" class="uk-grid-small uk-margin-medium-top" data-uk-grid>
                            <div class="row">
                                <div class="col-md-8">
                                    @isset($cart_items)
                                        @forelse ($cart_items as $items)
                                            <div class="comment-box">
                                                <div class="comment">
                                                    <article class="uk-comment uk-visible-toggle" tabindex="-1">
                                                        <header class="uk-comment-header uk-position-relative">
                                                            <div class="uk-grid-medium uk-flex-middle" data-uk-grid>
                                                                <div class="uk-width-auto">
                                                                    <img class="uk-comment-avatar uk-border-circle"
                                                                        src="/upload/{{ $items->product->image}}"
                                                                        width="50" height="50" alt="Product Image">
                                                                </div>
                                                                <div class="uk-width-expand">
                                                                    <h4 class="uk-comment-title uk-margin-remove"><a
                                                                            class="uk-link-reset"
                                                                            href="/shop/product/ {{$items->product['id'] }}">{{ $items->product['name'] }}</a>
                                                                    </h4>
                                                                    <p class="uk-comment-meta uk-margin-remove"><a
                                                                            class="uk-link-reset"
                                                                            href="#">${{ $items['product']->price }} x
                                                                            {{ $items->quantity }} Items</a></p>

                                                                </div>
                                                            </div>
                                                            <div
                                                                class="uk-position-top-right uk-position-small uk-hidden-hover">
                                                            </div>
                                                        </header>


                                                        <form action="/cart/delete" method="get">
                                                            @csrf
                                                            <input class="form-control" type="hidden"
                                                                value="{{ $items->id }}" name="cart_item_id">
                                                            <button class="btn btn-danger" value="delete " type="submit">Remove
                                                                Product from Cart</button>
                                                        </form>

                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-warning">
                                                Empty
                                            </div>
                                        @endforelse
                                    @endisset
                                </div>
                                <div class="col-md-4">

                                    <div class="uk-width-1-3@m">
                                        @if ($cart_items->count() > 0)
                                            <h3>Select Payment Method</h3>
                                        @else
                                            <h3>You have no Products in your basket</h3>
                                        @endif
                                        <ul class="uk-list uk-list-large uk-list-divider uk-margin-medium-top">
                                            @if ($cart_items->count() > 0)
                                                <li>Total Price USD :$ {{ $total }}</li>
                                                <li>
                                                    <a href="/paypal_visa">
                                                        <div>
                                                            <input type="submit"
                                                                value="Checkout via PAYPAL | MASTERCARD | VISA"
                                                                class="btn btn-success">
                                                        </div>
                                                    </a>
                                                </li>
                                                <br>
                                            @else
                                                <li>
                                                    <a href="/shop">
                                                        <p class="sign-up-single-button">
                                                            <input type="submit" value="  {{ __('Continue Shopping') }}">

                                                        </p>
                                                    </a>

                                                </li>
                                            @endif


                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="uk-margin-medium-top uk-margin-large-bottom">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
