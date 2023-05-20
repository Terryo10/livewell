@extends('layouts.app')

@section('content')
<section class="sign-up-area sign-in-area">
    <div class="sign-up-section-title">
        <h4>Sign in</h4>
        <span>Log In To Your Account</span>
    </div>

    <div class="sign-in-inner">
        <div class="sign-up-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf



                <p class="sign-up-single-input">
                    <label>{{ __('Email Address') }}*</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>

                <p class="sign-up-single-input">
                    <label>{{ __('Password') }}*</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>


                <div class="row mb-0">

                    <p class="sign-up-single-button">
                        <input type="submit" value="  {{ __('Login') }}">

                    </p>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>

    </div>
</section>

@endsection