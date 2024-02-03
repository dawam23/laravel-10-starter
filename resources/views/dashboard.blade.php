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
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter-lt text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $users->count() }} {{ __('users') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <x-slot name="scripts">
    </x-slot>
</x-layouts.app>
