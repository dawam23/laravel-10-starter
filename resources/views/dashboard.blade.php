@extends('layouts.app')

@section('content')
<div class="container-xl">

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-success">
                <div class="alert-title">
                    {{ __('Welcome') }} {{ auth()->user()->name ?? null }}
                </div>
                <div class="text-muted">
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
