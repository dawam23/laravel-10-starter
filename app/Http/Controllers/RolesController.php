<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:create roles|read roles|update roles|delete roles', ['only' => ['index']]);
        $this->middleware('permission:create roles', ['only' => ['create','store']]);
        $this->middleware('permission:update roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')
                    ->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usersPermissions = Permission::orderBy('name')
                                ->where('name', 'like', '%users')
                                ->get();

        $rolesPermissions = Permission::orderBy('name')
                                ->where('name', 'like', '%roles')
                                ->get();

        return view('roles.create', compact('usersPermissions', 'rolesPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                    ->with('message', 'New role successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id   = Crypt::decrypt($id);
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_has_permissions.role_id',$id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        $usersPermissions = Permission::orderBy('name')
                                ->where('name', 'like', '%users')
                                ->get();

        $rolesPermissions = Permission::orderBy('name')
                                ->where('name', 'like', '%roles')
                                ->get();

        $dashboardPermissions = Permission::orderBy('name')
                                ->where('name', 'like', '%dashboard')
                                ->get();

        $rolePermissions = DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id', $id)
                            ->pluck('role_has_permissions.permission_id')
                            ->all();

        return view('roles.edit', compact('role', 'usersPermissions', 'rolesPermissions', 'rolePermissions', 'dashboardPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id     = Crypt::decrypt($id);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('message', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id     = Crypt::decrypt($id);
        Role::find($id)->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
