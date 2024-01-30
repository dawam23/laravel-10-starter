<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')
                    ->get();

        $permissions = Permission::orderBy('name')
                    ->get();

        $roles = Role::orderBy('name')
                    ->get();

        return view('dashboard', compact(['users', 'permissions', 'roles']));
    }
}
