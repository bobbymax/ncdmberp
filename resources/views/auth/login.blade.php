@extends('layouts.blank')
@section('content')
<!-- Login Background Section -->
<div class="dt-login__bg-section" style="background-image: url({{ asset('images/bg.jpg') }});">

    <div class="dt-login__bg-content">
        <!-- Login Title -->
        <h1 class="dt-login__title">{{ __('Login') }}</h1>
        <!-- /login title -->

        <p class="f-16">Sign in here</p>
    </div>


    <!-- Brand logo -->
    <div class="dt-login__logo">
        <a class="dt-brand__logo-link" href="{{ url('/') }}">
            <img class="dt-brand__logo-img" src="{{ asset('images/logo.jpg') }}" alt="Drift">
        </a>
    </div>
    <!-- /brand logo -->

</div>
<!-- /login background section -->

<!-- Login Content Section -->
<div class="dt-login__content">

    <!-- Login Content Inner -->
    <div class="dt-login__content-inner">

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST">
        	@csrf

            <!-- Form Group -->
            <div class="form-group">
                <label class="sr-only" for="staff_no-1">{{ __('Email Address') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="staff_no-1" name="email" aria-describedby="staff_no-1" placeholder="Enter Email Address" value="{{ old('email') }}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- /form group -->

            <!-- Form Group -->
            <div class="form-group">
                <label class="sr-only" for="password-1">{{ __('Password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password-1" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- /form group -->

            <!-- Form Group -->
            <div class="dt-checkbox d-block mb-6">
                <input type="checkbox" name="remember" id="checkbox-1" {{ old('remember') ? 'checked' : '' }}>
                <label class="dt-checkbox-content" for="checkbox-1">
                    {{ __('Keep me login on this device') }}
                </label>
            </div>
            <!-- /form group -->

            <!-- Form Group -->
            <div class="form-group">
                <button type="submit" class="btn btn-success text-uppercase">{{ __('Login') }}</button>
            </div>
            <!-- /form group -->


        </form>
        <!-- /form -->

    </div>
    <!-- /login content inner -->

    <!-- Login Content Footer -->
    @if (Route::has('password.request'))
		<div class="dt-login__content-footer">
        	<a href="{{ route('password.request') }}" class="text-success">Can’t access your account?</a>
    	</div>
    @endif
    <!-- /login content footer -->

</div>
<!-- /login content section -->
@stop
