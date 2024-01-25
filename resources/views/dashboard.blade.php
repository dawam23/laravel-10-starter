<x-layouts.app>
    <x-slot name="styles">
    </x-slot>

    {{--  Page header  --}}

    <x-slot name="pretitle">
        {{ __('Howdy, mate!') }}
    </x-slot>

    <x-slot name="title">
        {{ __('Title') }}
    </x-slot>

    <x-slot name="subtitle">
        <div class="text-muted mt-1">
            {{ __('Subtitle') }}
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="#" class="btn btn-primary float-right">
                    <i class="fa fa-plus-square"></i> {{ __('Create New') }}
                </a>
            </div>
        </div>
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
