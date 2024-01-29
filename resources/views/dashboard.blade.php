<x-layouts.app>
    <x-slot name="styles">
    </x-slot>

    {{--  Page header  --}}

    <x-slot name="pretitle">
        {{ __('Overview') }}
    </x-slot>

    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    {{--  Page content  --}}
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

    <x-slot name="scripts">
    </x-slot>
</x-layouts.app>
