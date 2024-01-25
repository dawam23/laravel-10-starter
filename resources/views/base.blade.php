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
        <x-alerts.alerts />
        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $('#navUsers').addClass('active')
            $('#liBlank').addClass('active')
        </script>
    </x-slot>
</x-layouts.app>
