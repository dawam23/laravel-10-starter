<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">{{ __('Delete Account') }}&nbsp</h4>
        <span class="card-subtitle">
            {{ __("Once your account is deleted, all of its resources and data will be permanently deleted.") }}
        </span>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
                {{ __('Delete Account') }}
            </a>
        </div>

    </div>

    {{--  user confirmation modal  --}}
    <form method="POST" action="{{ route('profile.destroy') }}" class="modal modal-blur fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-hidden="true">
        @csrf
        @method('delete')
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">
                        {{ __('Are you sure you want to delete your account?') }}
                    </div>
                    <div>
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </div>
                    <div class="mt-3">
                        <label class="form-label required">{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="{{ __('Password') }}" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Yes, delete account') }}</button>
                </div>
            </div>
        </div>
    </form>

</div>
