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

class UsersController extends Controller
{
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
                ->addColumn('role', 'role')
                ->addColumn('action', function ($user) {
                    return view('users.partials.button-action', compact('user'));
                })
                ->rawColumns(['action', 'avatar', 'role'])
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
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

        User::create([
            'avatar' => $input['avatar'] ?? null,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

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

        return view('users.edit', compact('user'));
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
