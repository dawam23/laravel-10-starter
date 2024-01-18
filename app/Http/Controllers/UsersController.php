<?php

namespace App\Http\Controllers;

use App\Actions\UserAvatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', null);

        if (! empty($search)) {
            $this->validateSearch($request->all());
        }

        $users = new User();

        if (! is_null($search)) {
            $users = $users->where( function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        $total = $users->count();

        $users = $users->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('users.index', compact(
            'users', 'search', 'total',
        ));
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if (! empty($user->avatar)) {
            (new UserAvatar)->delete($user);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', __('User deleted!'));
    }

    private function validateSearch($input)
    {
        Validator::make($input, [
            'search' => [
                'string',
                'min:3'
            ],
        ])->validate();
    }
}
