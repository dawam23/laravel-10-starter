<?php

namespace App\Http\Controllers\Api;

use App\Actions\UserAvatar;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')
            ->get();

        return $this->sendResponse(UserResource::collection($users), __('Users Retrieved Successfully.'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return $this->sendResponse(new UserResource($user), __('New user added successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('failed', __('User is not found!'), 200);
        }

        return $this->sendResponse(new UserResource($user), __('New user added successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
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

        return $this->sendResponse(new UserResource($user), __('User update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (!empty($user->avatar)) {
            (new UserAvatar)->delete($user);
        }

        $user->delete();

        return $this->sendResponse([], __('User has been successfully deleted.'));
    }
}
