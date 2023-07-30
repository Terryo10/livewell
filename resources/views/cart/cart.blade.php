@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section class="w-100 p-5 gradient-custom" style="border-radius: .5rem .5rem 0 0;">
        <style>
            .gradient-custom {
                /* fallback for old browsers */
                background: #6a11cb;

                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
            }
        </style>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">{{ auth()->user()->name }}'s Shopping Cart -
                            {{ $cart_items ? $cart_items->count() : 0 }} items</h5>
                    </div>
                    <div class="card-body">
                        @isset($cart_items)
                            @forelse ($cart_items as $items)
                                <!-- Single item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                            data-mdb-ripple-color="light">
                                            <img src="/upload/{{ $items->product->image }}" class="w-100"
                                                alt="{{ $items->product->name }}">
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $items->product->name }}</strong></p>
                                        <p>Color: blue</p>
                                        <p>Size: M</p>
                                        <form action="/cart/delete" method="get">
                                            @csrf
                                            <input class="form-control" type="hidden" value="{{ $items->id }}"
                                                name="cart_item_id">
                                            <button type="submit" class="btn btn-primary btn-sm me-1 mb-2"
                                                data-mdb-toggle="tooltip" aria-label="Remove item"
                                                data-mdb-original-title="Remove item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                            aria-label="Move to the wish list" data-mdb-original-title="Move to the wish list">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                            <button class="btn btn-primary px-3 me-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <div class="form-outline">
                                                <input id="form1" min="0" name="quantity" max="{{$items->product->stock}}"
                                                    value="{{ $items->quantity }}" type="number" class="form-control active">
                                                <label class="form-label" for="form1"
                                                    style="margin-left: 0px;">Quantity</label>
                                                <div class="form-notch">
                                                    <div class="form-notch-leading" style="width: 9px;"></div>
                                                    <div class="form-notch-middle" style="width: 36.8px;"></div>
                                                    <div class="form-notch-trailing"></div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary px-3 ms-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- Quantity -->

                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong>$ {{ $items->product->price }} </strong>
                                            <form action="{{route('savetocart')}}" class="product-cart" method="post">
                                                @csrf
                                                    <div class="product-quantity quantity">
                                                        <input id="Quantity" name="quantity" value="1" data-product-qty=""
                                                            class="cart__quantity-selector quantity-selector" type="text" min="1" max="{{$items->product->stock}}" >
                                                        <input value="-" class="qtyminus looking" type="button">
                                                        <input value="+" class="qtyplus looking" type="button">
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{$items->product->id}}">
                                                    <div class="ingredient_slider_btn">
                                                        <button type="submit" class="single_add_to_cart_button">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            Update Quantity
                                                        </button>
                                                        {{-- <a class="this_heart" href="#">
                                                            <i class="far fa-heart"></i>
                                                        </a> --}}
                                                        {{-- <p><i class="fas fa-check"> </i> ADDED TO CART SUCCESSFULLY !</p> --}}
                                                    </div>
                                                </form>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                </div>
                                <!-- Single item -->
                            @empty
                                <div class="alert alert-warning">
                                    Empty
                                </div>

                                <hr class="my-4">
                            @endforelse
                        @endisset

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Expected shipping delivery</strong></p>
                        <p class="mb-0">...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        @if ($cart_items != null)
                            @if ($cart_items->count() > 0)
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Total
                                        <span>$ {{ $total }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Shipping
                                        <span>USD</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p class="mb-0">(including VAT)</p>
                                            </strong>
                                        </div>
                                        <span><strong>$ {{ $total }}</strong></span>
                                    </li>
                                </ul>
                                <form method="post" action="/paynow_visa">
                                    @csrf
                                    <div>
                                        <input type="hidden" name="total" value="{{ $total }}"
                                            class="btn btn-success" />
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Checkout Using VISA | MASTERCARD
                                        </button>
                                </form>
                                <form method="get" action="/shipping_details" style="margin-top: 10px;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Edit Shipping Details
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="/shop">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Add Products
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
