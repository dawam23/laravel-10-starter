@extends('layouts.guest')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
    </div>
    <form class="card card-md" action="{{ route('password.confirm') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Confirm Password') }}</h2>

            <p class="text-muted mb-4">{{ __('Please confirm your password before continuing.') }}</p>

            <div class="mb-3">
                <label class="form-label required">
                    {{ __('Password') }}
                    @if (Route::has('password.request'))
                    <span class="form-label-description">
                        <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                    </span>
                    @endif
                </label>

                {!! Form::password('password', [
                'class' => 'form-control form-control-user' . ( $errors->has('password' ? ' is-invalid' : '') ),
                'placeholder'=> __('Enter Password')
                ]) !!}

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Confirm Password') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
