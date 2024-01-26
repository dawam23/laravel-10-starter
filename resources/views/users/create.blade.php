<x-layouts.app>
    <div class="container-xl">
        <div class="row">
            <div class="col">
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ __('User Information') }}
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">{{ __('Profile Picture') }}</label>
                                <div class="col-md-7">
                                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept=".png,.jpg,.jpeg,.gif,.webp">
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label required">{{ __('Name') }}</label>
                                <div class="col-md-7">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label required">{{ __('Email') }}</label>
                                <div class="col-md-7">
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                                    @error('eamil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label required">{{ __('Password') }}</label>
                                <div class="col-lg-3 col-md-7">
                                    <input type="password" name="password" placeholder="{{ __('Enter password') }}" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- /.form-group -->

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label required">{{ __('Confirm Password') }}</label>
                                <div class="col-lg-3 col-md-7">
                                    <input type="password" name="password_confirmation" placeholder="{{ __('Enter password confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" required >
                                    @error('password_confirmation')
                                        <div class="invalid-feedback"></div>
                                    @enderror
                                </div>
                            </div><!-- /.form-group -->

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
                                        {{ __('Create User') }}
                                    </button>
                                </div>
                            </div>
                        </div><!-- /.card-footer -->
                    </div><!-- /.card -->
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
