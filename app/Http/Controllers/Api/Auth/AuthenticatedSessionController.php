<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller as ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends ApiController
{
    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validate->fails()) {
            return $this->sendError('Validation Error!', $validate->errors(), 403);
        }

        // Check email exist
        $user = User::where('email', $request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError(trans('auth.failed'), [], 401);
        }

        $data = new UserResource($user);
        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        return $this->sendResponse($data, __('User is logged in successfully.'));
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse(null, __('User is logged out successfully'));
    }
}
