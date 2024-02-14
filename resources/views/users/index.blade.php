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
                                    <th class="no-sort w-1"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th class="no-sort w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <span class="avatar me-2" style="background-image: url({{ $user->getAvatarUrl() }})">
                                            {{ $user->getInitialsAvatar() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $user->name }}</div>
                                                <div class="text-muted">
                                                    <a href="#" class="text-reset">{{ $user->email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Lorem, ipsum dolor.</div>
                                        <div class="text-muted">Lorem.</div>
                                    </td>
                                    <td class="text-muted">
                                        <span class="badge badge-outline text-success">{{ __('User') }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('users.edit', Crypt::encrypt($user->id)) }}">
                                                    {{ __('Edit') }}
                                                </a>
                                                <a class="dropdown-item" href="#"
                                                    data-action="{{ route('users.destroy', Crypt::encrypt($user->id)) }}"
                                                    data-name="{{ $user->name }}" data-bs-toggle="modal"
                                                    data-bs-target="#delete-user">
                                                    {{ __('Delete') }}
                                                </a>
                                            </div>
                                        </div>
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

    @include('users.partials.modal-delete')

    <x-slot name="scripts">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        @include('users.partials.scripts')

    </x-slot>
</x-layouts.app>
