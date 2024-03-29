@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($user->subscribed == null)
                            <div class="alert alert-danger" role="alert">
                                {{ __('You dont have an active subscription please subscribe to get access to our articles') }}
                            </div>
                            <a href="/subscriptions">
                                <p class="sign-up-single-button">
                                    <input style="width: fit-content !important;" type="submit" value="  {{ __(' Subscribe Now') }}">

                                </p>
                            </a>
                        @elseif ($user->subscribed?->expires_at < Carbon\Carbon::now())
                            <div class="alert alert-warning" role="alert">
                                {{ __('Your subscription is not active please subscribe to have unlimited access to articles and post on our website') }}

                            </div>
                            <livewire:subscription-payment :token="$token" :pricing="$pricing" />
                        @else
                            <div class="alert alert-success" role="alert">
                                {{ __('Your subscription is active') }}
                            </div>
                            <a class="btn-btn-primary">
                                Your subscription expires on
                                {{ \Carbon\Carbon::parse(Auth::user()->subscribed->expires_at)->diffForHumans() }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($orders->count() == 0)
                        <div class="alert alert-success">
                            <p>You have no orders yet <a href="shop">click here to start shopping</a></p>
                        </div>
                    @endif
                    @foreach ($orders as $items)
                        <div class="card">
                            <div class="card-header">Order id : {{ $items->id }}
                                {{-- ({{ $items->transaction_ref }}) --}}
                            </div>

                            <div class="card-body">
                                @if ($items->order_transaction)
                                    @if ($items->order_transaction->status == 'paid')
                                        {{-- @foreach ($items->order_items as $lols) --}}
                                        @foreach ($items->order_items as $key=>$thing)
                                            <div class="uk-width-auto">
                                                <img class="uk-comment-avatar uk-border-circle"
                                                    src="/upload/{{ $thing->product['image'] }}" width="50"
                                                    height="50" alt="Product Image">
                                            </div>
                                            <br>
                                            <div class="col-md-6">
                                                <p> {{ $thing->product['name'] }} X{{ $thing->quantity }} For
                                                    ${{ $thing->product->price }}</p>

                                                <button type="submit" style="width: fit-content !important;" class="btn btn-primary btn-lg btn-block">
                                                    Order Paid
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                    @foreach ($items->order_items as $key=>$thing)
                                            <div class="uk-width-auto">
                                                <img class="uk-comment-avatar uk-border-circle"
                                                    src="/upload/{{ $thing->product['image'] }}" width="50"
                                                    height="50" alt="Product Image">
                                            </div>
                                            <br>
                                            <div class="col-md-6">
                                                <p> {{ $thing->product['name'] }} X{{ $thing->quantity }} For
                                                    ${{ $thing->product->price }}</p>
                                                <form method="post" action="/paynow_visa">
                                                    @csrf

                                                    <input type="hidden" name="total" value="{{ $thing->quantity * $thing->product->price }}"
                                                        class="btn btn-success" />
                                                    <input type="hidden" name="tran_id" value="{{ $items->order_transaction->id }}"
                                                        class="btn btn-warning" />
                                                    <button style="width: fit-content !important;" type="submit" class="btn btn-primary btn-lg btn-block">
                                                        Order Not Paid Pay using PayNow
                                                    </button>
                                                </form>
                                                <form method="post" action="/handle-payment">
                                                    @csrf
                                                   <input type="hidden" name="order" value="1" />
                                                    <input type="hidden" name="total" value="{{ $thing->quantity * $thing->product->price }}"
                                                        class="btn btn-success" />
                                                    <input type="hidden" name="tran_id" value="{{ $items->order_transaction->id }}"
                                                        class="btn btn-warning" />
                                                    <button style="width: fit-content !important;margin: 20px 0px;" type="submit" class="btn btn-primary btn-lg btn-block">
                                                     Pay Using PayPal
                                                    </button>
                                                </form>
                                                <a href="/confirm-payment/{{ $items->order_transaction->id }}">
                                                    <button style="width: fit-content !important;" type="submit" class="btn btn-warning btn-lg btn-block">
                                                        ReCheck Order Status
                                                    </button>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                @else
                                <div class="col-md-10">
                                    <p>
                                      Something happened to this order please contact us through our live chat
                                    </p>
                                </div>

                                @endif
                            </div>
                        </div>
                        <br>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($booking as $items)
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"> Your booking ID is : {{ $items->id }}
                            </div>

                            <div class="card-body">
                                <p>
                                    Your Booking Order Transaction Reference is
                                    ({{ $items->transaction_ref }})
                                    <br>
                                </p>
                                <p>
                                    Consultation Date is :
                                    ( {{ $items->consultation->date }} ) <br>

                                </p>
                                <p>
                                    Consultation Status is :
                                    ( {{ $items->consultation->status }} ) <br>
                                </p>
                                <p>
                                    Phone number assigned to this consultation is :
                                    ( {{ $items->consultation->phone }} ) <br>
                                </p>
                                <p>
                                    There was an email sent to you with the consultation details, please check your email
                                    ( {{ Auth::user()->email }} ) for more info please chat to us in our live chat<br>

                                </p>
                                @if ($items->transaction->status == 'pending')
                                    <p>You booking is not yet paid please pay now
                                    <p>
                                    @elseif($items->transaction->status == 'paid')
                                    <p>You booking was success full
                                    <p>
                                    @else
                                    <p>Please check your payment status for your booking to procced
                                    <p>
                                @endif
                            </div>
                        </div>
                        <br>
                    </div>

                    <br>
                @endforeach
            </div>
        </div>
        <br>
        <br>

    </div>
@endsection
