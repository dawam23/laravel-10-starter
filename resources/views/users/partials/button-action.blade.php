<div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Action</a>
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
