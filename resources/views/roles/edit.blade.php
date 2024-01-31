<x-layouts.app>
    <x-slot name="styles">
    </x-slot>
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <form action="{{ route('roles.update', Crypt::encrypt($role->id)) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            {{ __('Role Information') }}
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                {!! Form::label('name', __('Name'), ['class' => 'col-md-3 col-form-label required']) !!}
                                <div class="col-md-7">

                                    {!! Form::text('name', old('name', $role->name), [
                                        'class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ),
                                        'placeholder' => __('Role name'),
                                        'required',
                                        'autofocus'
                                    ]) !!}

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="card-header">
                            {{ __('Role Permissions') }}
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="row mb-3">

                                        <div class="col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Users Access') }}</div>
                                                <div>
                                                    @foreach ($usersPermissions as $permission)
                                                        <label class="form-check">
                                                            {!! Form::checkbox('permission[]', $permission->name, in_array($permission->id, $rolePermissions), ['class' => 'form-check-input']) !!}
                                                            <span class="form-check-label">{{ Str::title($permission->name) }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Roles Access') }}</div>
                                                <div>
                                                    @foreach ($rolesPermissions as $permission)
                                                        <label class="form-check">
                                                            {!! Form::checkbox('permission[]', $permission->name, in_array($permission->id, $rolePermissions), ['class' => 'form-check-input']) !!}
                                                            <span class="form-check-label">{{ Str::title($permission->name) }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary float-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <line x1="5" y1="12" x2="11" y2="18"></line>
                                            <line x1="5" y1="12" x2="11" y2="6"></line>
                                        </svg>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>

                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                            <circle cx="12" cy="14" r="2"></circle>
                                            <polyline points="14 4 14 8 8 8 8 4"></polyline>
                                        </svg>
                                        {{ __('Update Role') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            $('#navRoles').addClass('active')
        </script>
    </x-slot>
</x-layouts.app>
