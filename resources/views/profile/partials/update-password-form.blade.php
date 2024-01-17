<form action="{{ route('password.update') }}" method="POST" class="card mt-4">
    @csrf
    @method('PUT')

    <div class="card-header">
        <h4 class="card-title">{{ __('Update Password') }}&nbsp</h4>
        <span class="card-subtitle">
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </span>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label required">{{ __('Current Password') }}</label>
            <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" placeholder="{{ __('Current password') }}">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label required">{{ __('New password') }}</label>
            <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" placeholder="{{ __('New password') }}">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label required">{{ __('New password confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" placeholder="{{ __('New password confirmation') }}" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>

</form>
