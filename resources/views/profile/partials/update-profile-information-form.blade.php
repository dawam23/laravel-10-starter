<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form action="{{ route('profile.update') }}" method="POST" class="card" autocomplete="off">
    @csrf
    @method('patch')

    <div class="card-header">
        <h4 class="card-title">{{ __('Profile Information') }}&nbsp</h4>
        <span class="card-subtitle">
            {{ __("Update your account's profile information and email address.") }}
        </span>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label required">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label required">{{ __('Email address') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <span>{{ __('Your email address is unverified.') }}</span>
            <button form="send-verification" class="btn btn-sm btn-ghost-info ">
                {{ __('Click here to re-send the verification email.') }}
            </button>
        @endif

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>

</form>
