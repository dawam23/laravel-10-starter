<x-layouts.app>

    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    </x-slot>

    {{--  Page header  --}}
    <x-slot name="title">
        {{ __('Users') }}
    </x-slot>

    <x-slot name="actions">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    {{ __('New user') }}
                </a>
            </div>
        </div>
    </x-slot>

    {{--  Page content  --}}
    <div class="container-xl">
        <x-alerts.alerts />
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Users List') }}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table card-table table-vcenter text-nowrap datatable py-4" id="usersTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2" style="background-image: url({{ $user->getAvatarUrl() }})">{{ $user->getInitialsAvatar() }}</span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $user->name }}</div>
                                                    <div class="text-muted"><a href="#" class="text-reset">{{ $user->email }}</a></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div>Lorem, ipsum dolor.</div>
                                            <div class="text-muted">Lorem.</div>
                                        </td>
                                        <td class="text-muted" >
                                            {{ Str::random(3) }}
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $user->id }}">
                                                        Delete
                                                    </a>
                                                </div>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="post" id="modal-delete-{{ $user->id }}" class="modal modal-blur fade" tabindex="-1" role="dialog" aria-hidden="true">
            @csrf
            @method('DELETE')
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-title">{{ __('Attantion') }}</div>
                        <div>
                                {{ __('Are you sure you want to delete ') }}
                                <span class="text text-success">{{ $user->name }}</span>
                                {{ __(' from database?')}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Yes, delete this user') }}</button>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    <x-slot name="scripts">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $('#navUsers').addClass('active')
            $('#liBlank').addClass('active')

            $('#usersTable').dataTable( {
                //option
                } );

            $('div.dataTables_length').addClass('ps-4');
            $('#usersTable_filter').addClass('pe-4');
            $('div.dataTables_info').addClass('ps-4');
            $('#usersTable_paginate').addClass('pe-4');

        </script>
    </x-slot>
</x-layouts.app>

