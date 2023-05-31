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
                                {{ __('You dont have an active subscription') }}
                            </div>
                            <a class="btn-btn-primary" href="/subscriptions">
                                Subscribe Now
                            </a>
                        @elseif ($user->subscribed?->expires_at < Carbon\Carbon::now())
                            <div class="alert alert-warning" role="alert">
                                {{ __('Your subscription is not active please subscribe to have unlimited access to articles and post on our website') }}

                            </div>
                            <livewire:subscription-payment :token="$token" :pricing="$pricing">
                            @else
                                <div class="alert alert-success" role="alert">
                                    {{ __('Your subscription is still active') }}
                                </div>
                                <a class="btn-btn-primary">
                                    Your subscription expires on {{Auth::user()->subscribed->expires_at}}
                                </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

    </div>
@endsection
