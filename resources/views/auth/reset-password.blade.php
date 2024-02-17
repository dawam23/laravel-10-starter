@extends('layouts.guest')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
    </div>
    <form class="card card-md" action="{{ route('password.store') }}" method="POST" autocomplete="off">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Reset Password') }}</h2>

            <div class="mb-3">

                {!! Form::label('email', __('Email address'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::email('email', old('email', $request->email), [
                'class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),
                'placeholder' => __('Email Address'),
                'required',
                'autocomplete' => 'email',
                'autofocus'
                ]) !!}

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">

                {!! Form::label('password', __('New Password'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::password('password', [
                'class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : ''),
                'placeholder' => __('New Password')
                ]) !!}

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">

                {!! Form::label('password', __('Repeat New Password'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::password('password_confirmation', [
                'class' => 'form-control' . ( $errors->has('password_confirmation') ? ' is-invalid' : ''),
                'placeholder' => __('Repeat New Password')
                ]) !!}

                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Reset My Password') }}
                </button>
            </div>
        </div>
    </form>

    @if (Route::has('login'))
    <div class="text-center text-muted mt-3">
        {{ __('Already have account?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
    </div>
    @endif
</div>
@endsection
