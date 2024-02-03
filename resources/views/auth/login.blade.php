@extends('layouts.guest')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
    </div>
    <form class="card card-md" action="{{ route('login') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Login to your account') }}</h2>

            <div class="mb-3">

                {!! Form::label('email', __('Email address'), ['class' => 'form-label']) !!}

                {!! Form::email('email', old('email'), [
                'class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),
                'placeholder' => __('Enter email'),
                'required',
                'autofocus',
                'tabindex' => '1'
                ]) !!}

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    {{ __('Password') }}
                    @if (Route::has('password.request'))
                    <span class="form-label-description">
                        <a href="{{ route('password.request') }}" tabindex="5">{{ __('Forgot Password?') }}</a>
                    </span>
                    @endif
                </label>

                {!! Form::password('password', [
                'class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ),
                'placeholder' => __('Password'),
                'required',
                'tabindex' => '2'
                ]) !!}

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" tabindex="3" name="remember" />
                    <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                </label>
            </div>

            <div>
                {!! htmlFormSnippet() !!}
                @error('g-recaptcha-response')
                <div class="text text-danger">{{ __('Google recaptcha is required') }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100" tabindex="4">{{ __('Sign in') }}</button>
            </div>
        </div>
    </form>

    @if (Route::has('register'))
    <div class="text-center text-muted mt-3">
        {{ __("Don't have account yet?") }}
        <a href="{{ route('register') }}" tabindex="-1">{{ __('Sign up') }}</a>
    </div>
    @endif
</div>
@endsection
