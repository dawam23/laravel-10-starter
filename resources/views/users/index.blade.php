<x-layouts.app>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    </x-slot>

    {{-- Page header --}}
    <x-slot name="title">
        {{ __('Users') }}
    </x-slot>

    <x-slot name="actions">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="{{ route('users.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    {{ __('New user') }}
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-primary d-sm-none btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Page content --}}
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Users List') }}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table card-table table-vcenter text-nowrap table-striped datatable py-4" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="w-1"></th>
                                    <th class="w-1"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('users.partials.modal-delete')

    <x-slot name="scripts">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        @include('users.partials.scripts')

    </x-slot>
</x-layouts.app>
