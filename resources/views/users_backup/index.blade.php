@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Users') }}
                </h2>
                <div class="text-secondary mt-1">
                    There {{ $total > 1 ? 'are' : 'is' }} {{ $total }} users on the system
                </div>
            </div>

            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <form action="{{ route('users.index') }}" method="get" class="me-2">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control d-inline-block w-9" value="{{ $search ?? '' }}" placeholder="{{ __('Search user…') }}"/>
                            <button type="submit" class="btn btn-outline-success">{{ __('Search') }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('Reset') }}</a>
                        </div>
                    </form>

                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    {{ __('New user') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        @if ($users->count() < 1)
        <div class="text-info text-center mb-0 py-4">
            {{ __('No result.') }}
        </div>
        @else
        <div class="row row-cards">
            @foreach ($users as $user)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        @if (auth()->user()->id === $user->id)
                            <div class="card-status-top bg-danger"></div>
                            <div class="ribbon bg-red">{{ __('YOU') }}</div>
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('$user->avatar')">{{ $user->avatar == null ? $user->getInitials() : '' }}</span>
                                <h3 class="m-0 mb-1"><a href="{{ route('profile.edit') }}">{!! \App\Http\Helpers\StrHelper::highlight($search, $user->name) !!}</a></h3>
                                <div class="text-secondary">{!! \App\Http\Helpers\StrHelper::highlight($search, $user->email) !!}</div>
                                <div class="mt-3">
                                    <span class="badge bg-success-lt">User</span>
                                </div>
                            </div>
                        @else
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('$user->avatar')">{{ $user->avatar == null ? $user->getInitials() : '' }}</span>
                                <h3 class="m-0 mb-1"><a href="{{ route('users.edit', $user) }}">{!! \App\Http\Helpers\StrHelper::highlight($search, $user->name) !!}</a></h3>
                                <div class="text-secondary">{!! \App\Http\Helpers\StrHelper::highlight($search, $user->email) !!}</div>
                                <div class="mt-3">
                                    <span class="badge bg-success-lt">{{ __('User') }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex">
                            @if (auth()->user()->id === $user->id)
                                <a href="{{ route('profile.edit')  }}" class="card-btn text-info"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 11l2 2l4 -4"></path>
                                    </svg>
                                    {{ __('Profile') }}
                                </a>
                            @else
                                <a href="{{ route('users.edit', $user) }}" class="card-btn text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                        <line x1="16" y1="5" x2="19" y2="8"></line>
                                    </svg>
                                    Edit
                                </a>
                                <a href="#" class="card-btn text-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $user->id }}">
                                    <x-icons.trash class="me-2" />
                                    {{ __('Delete') }}
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post" id="modal-delete-{{ $user->id }}" class="modal modal-blur fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="modal-title">{{ __('Are you sure?') }}</div>
                                                <div>{{ __('Are you sure you want to delete this user?') }}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Yes, delete this user') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.js" integrity="sha512-HNbo1d4BaJjXh+/e6q4enTyezg5wiXvY3p/9Vzb20NIvkJghZxhzaXeffbdJuuZSxFhJP87ORPadwmU9aN3wSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready( function () {

        $('.btn-delete-user').click( function (e) {
            e.preventDefault()

            if (confirm('{{ __('Are you sure you want to delete this user?') }}')) {
                let id = $(this).attr('data-id')

                $('#user-delete-' + id).submit()
            }
        })

    })
</script>
@endpush
