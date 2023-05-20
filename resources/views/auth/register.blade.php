@extends('layouts.app')

@section('content')
<section class="sign-up-area sign-in-area">
    <div class="sign-up-section-title">
        <h4>Sign Up</h4>
        <span>Create Your Account</span>
    </div>

    <div class="sign-in-inner">
        <div class="sign-up-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf


                <p class="sign-up-single-input">
                    <label>{{ __('Name') }}*</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
                <p class="sign-up-single-input">
                    <label>{{ __('Email Address') }}*</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>



                <p class="sign-up-single-input">
                    <label>{{ __('Password') }}*</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>



                <p class="sign-up-single-input">
                    <label>{{ __('Confirm Password') }}*</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                </p>



                <p class="sign-up-single-button">
                    <input type="submit" value=" {{ __('Register') }}">

                </p>
            </form>
        </div>
    </div>
</section>
@endsection