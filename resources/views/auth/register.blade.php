@extends('layouts.guest')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
    </div>
    <form class="card card-md" action="{{ route('register') }}" method="POST">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Create new account') }}</h2>

            <div class="mb-3">

                {!! Form::label('name', __('Name'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::text('name', old('name'), [
                'class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ),
                'placeholder' => __('Name'),
                'required',
                'autofocus',
                'autocomplete' => 'name'
                ]) !!}

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">

                {!! Form::label('email', __('Email address'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::email('email', old('email'), [
                'class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),
                'placeholder' => __('Email Address'),
                'required',
                'autocomplete' => 'email'
                ]) !!}

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">

                {!! Form::label('password', __('Password'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::password('password', [
                'class' => 'form-control' . ( $errors->has('password' ? ' is-invalid' : '')),
                'placeholder' => __('Password'),
                'required',
                'autocomplete' => 'new-password'
                ]) !!}

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">

                {!! Form::label('password_confirmation', __('Repeat Password'), [
                'class' => 'form-label required'
                ]) !!}

                {!! Form::password('password_confirmation', [
                'class' => 'form-control form-control-user' . ( $errors->has('password_confirmation') ? ' is-invalid' : '' ),
                'placeholder' => __('Repeat Password'),
                'required',
                'autocomplete' => 'new-password'
                ]) !!}

                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
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
