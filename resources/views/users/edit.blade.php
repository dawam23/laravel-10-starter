<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <x-alerts.alerts />
            <div class="col">
                <form action="{{ route('users.update', Crypt::encrypt($user->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            {{ __('User Information') }}
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                {!! Form::label('avatar', __('Profile Picture'), ['class' => 'col-md-3 col-form-label']) !!}
                                <div class="col-md-7">

                                    {!! Form::file('avatar', [
                                        'class' => 'form-control' . ( $errors->has('avatar') ? ' is-invalid' : '' ),
                                        'accept' => '.png,.jpg,.jpeg,.gif,.webp'
                                    ]) !!}

                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if (! empty($user->avatar))
                                    <div class="col-md-4 offset-md-3">
                                        <div class="text-danger mt-3">
                                            <em>
                                                {{ __('Uploading new picture will delete the old one automatically.') }}
                                            </em>
                                        </div>
                                        <span class="avatar avatar-xl" style="background-image: url({{ (new App\Actions\UserAvatar)->get($user) }})"></span>
                                        <div class="text-danger mt-1">
                                            <a
                                                href="{{ route('users.delete-avatar', $user) }}"
                                                class="btn btn-danger">
                                                {{ __('Delete Profile Picture') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row mb-3">
                                {!! Form::label('name', __('Name'), ['class' => 'col-md-3 col-form-label required']) !!}
                                <div class="col-md-7">

                                    {!! Form::text('name', old('name', $user->name), [
                                        'class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ),
                                        'placeholder' => __('Full name'),
                                        'required',
                                        'autofocus'
                                    ]) !!}

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                {!! Form::label('email', __('Email'), ['class' => 'col-md-3 col-form-label required']) !!}
                                <div class="col-md-7">

                                    {!! Form::email('email', old('email', $user->email), [
                                        'class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),
                                        'placeholder' => __('Email Address'),
                                        'required'
                                    ]) !!}

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                {!! Form::label('password', __('Password'), ['class' => 'col-md-3 col-form-label']) !!}
                                <div class="col-md-3">

                                    {!! Form::password('password', [
                                        'class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ),
                                        'placeholder' => __('password'),
                                    ]) !!}

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                {!! Form::label('password_confirmation', __('Confirm Password'), ['class' => 'col-md-3 col-form-label']) !!}
                                <div class="col-md-3">

                                    {!! Form::password('password_confirmation', [
                                        'class' => 'form-control' . ( $errors->has('password_confirmation') ? ' is-invalid' : '' ),
                                        'placeholder' => __('Confirm password'),
                                    ]) !!}

                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary float-left">
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
                                        {{ __('Update User') }}
                                    </button>
                                </div>
                            </div>
                        </div><!-- /.card-footer -->
                    </div><!-- /.card -->
                </form>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $('#navUsers').addClass('active')
        </script>
    </x-slot>

</x-layouts.app>
