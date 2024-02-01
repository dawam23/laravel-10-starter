<x-layouts.app>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    </x-slot>

    {{--  Page header  --}}
    <x-slot name="title">
        {{ __('Roles') }}
    </x-slot>

    @can('create roles')
        <x-slot name="actions">
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        {{ __('New role') }}
                    </a>
                </div>
            </div>
        </x-slot>
    @endcan

    {{--  Page content  --}}
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Roles List') }}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table card-table table-vcenter text-nowrap table-striped datatable py-4" id="rolesTable">
                            <thead>
                                <tr>
                                    <th class="no-sort w-1"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Guard Name') }}</th>
                                    <th class="no-sort w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <span class="avatar me-2">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ Str::title($role->name) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted" >
                                            <span class="badge badge-outline text-success">{{ Str::title($role->guard_name) }}</span>
                                        </td>
                                        <td class="text-end">
                                            @canany(['update roles', 'delete roles'])
                                                @if ($role->name != 'Super Admin')
                                                    <span class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @can('update roles')
                                                                <a class="dropdown-item" href="{{ route('roles.edit', Crypt::encrypt($role->id)) }}">
                                                                    {{ __('Edit') }}
                                                                </a>
                                                            @endcan
                                                            @can('delete roles')
                                                                <button type="button" class="dropdown-item" data-action="{{ route('roles.destroy', Crypt::encrypt($role->id)) }}" data-name="{{ $role->name }}" data-bs-toggle="modal" data-bs-target="#delete-role" >
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            @endcan
                                                        </div>
                                                    </span>
                                                @endif
                                            @endcanany
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

    {{--  delete role modal  --}}
    <div class="modal modal-blur fade" id="delete-role" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                        <h3>{{ _('Are you sure?') }}</h3>
                        <div>
                            <span class="text-secondary">
                                {{ __('Do you really want to delete role with name') }}
                            </span>
                            <span class="text-info" id="role-name"></span>
                            <span class="text-secondary">
                                {{ ("? What you've done cannot be undone.") }}
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                        Delete role
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $('#navRoles').addClass('active')
            $('#rolesTable').dataTable( {
                    // set index of column to set default ordering
                    order: [[1, 'asc']],
                    //defind class for non-sortable column
                    "columnDefs": [ {
                        "targets": 'no-sort',
                        "orderable": false,
                        }],
                } );
        </script>
        <script>
            $('#delete-role').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var name = button.data('name');
                var modal = $(this);
                modal.find('form').attr('action', action);
                $('#role-name').text(name)
            });
        </script>
    </x-slot>
</x-layouts.app>

