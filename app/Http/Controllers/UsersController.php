<?php

namespace App\Http\Controllers;

use App\Actions\UserAvatar;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:create users|read users|update users|delete users', ['only' => ['index']]);
        $this->middleware('permission:create users', ['only' => ['create', 'store']]);
        $this->middleware('permission:update users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $users = User::orderBy('name')
                ->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('avatar', function($user){
                    return '<span class="avatar me-2" style="background-image: url(' . $user->getAvatarUrl() . ')">
                                ' . $user->getInitialsAvatar() . '
                            </span>';
                })
                ->addColumn('name', function($user){
                    return '<div class="d-flex py-1 align-items-center">
                                <div class="flex-fill">
                                    <div class="font-weight-medium">' . $user->name . '</div>
                                    <div class="text-muted">
                                        <a href="#" class="text-reset">' . $user->email .'</a>
                                    </div>
                                </div>
                            </div>';
                })
                ->addColumn('role', function ($user) {
                    foreach ($user->roles->pluck('name') as $roles) {
                        return '<span class="badge badge-outline text-success">' . $roles . '</span>';
                    }
                })
                ->addColumn('action', function ($user) {
                    return '<div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Action</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="' . route('users.edit', Crypt::encrypt($user->id)) . '">
                                        ' . __('Edit') . '
                                    </a>
                                    <a class="dropdown-item" href="#"
                                        data-action="' . route('users.destroy', Crypt::encrypt($user->id)) . '"
                                        data-name="{{ $user->name }}" data-bs-toggle="modal"
                                        data-bs-target="#delete-user">
                                        ' . __('Delete') . '
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['name', 'avatar', 'role', 'action'])
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rolesList = Role::all()
            ->sortBy('name')
            ->pluck('name', 'name')
            ->merge(['' => 'Select role']);

        return view('users.create', compact('rolesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();

        if (isset($input['avatar'])) {
            $input['avatar'] = (new UserAvatar)->upload($input['avatar']);
        }

        $user = User::create([
            'avatar' => $input['avatar'] ?? null,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole($input['role']);

        return redirect()
            ->route('users.index')
            ->with('message', __('New user added successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id     = Crypt::decrypt($id);
        $user   = User::find($id);
        $rolesList = Role::all()
            ->sortBy('name')
            ->pluck('name', 'name')
            ->merge(['' => 'Select role']);

        return view('users.edit', compact('user', 'rolesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $id     = Crypt::decrypt($id);
        $user   = User::findorFail($id);
        $input  = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if (isset($input['avatar'])) {
            if (!empty($user->avatar)) {
                (new UserAvatar)->delete($user);
            }
            $input['avatar'] = (new UserAvatar)->upload($input['avatar']);
        }

        $user->update($input);
        $user->syncRoles($request->input('role'));

        return redirect()
            ->route('users.index')
            ->with('message', __('User update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id     = Crypt::decrypt($id);
        $user = User::findOrFail($id);

        if (!empty($user->avatar)) {
            (new UserAvatar)->delete($user);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', __('User has been successfully deleted.'));
    }

    /**
     * Delete a user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAvatar(User $user)
    {
        if (!empty($user->avatar)) {
            (new UserAvatar)->delete($user);
        }

        $user->avatar = null;
        $user->save();

        return redirect()
            ->back()
            ->with('message', __('Avatar has been successfully deleted.'));
    }
}
