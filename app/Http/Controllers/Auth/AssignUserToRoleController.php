<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DataTables\AssignRoleDataTables;
use App\Http\Requests\StoreUserToRoleRequest;
use App\Http\Requests\UpdateUserToRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignUserToRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(AssignRoleDataTables $dataTable)
    {
        return $dataTable->render('permissions.user.index');
    }

    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        return view('permissions.user.create', compact('roles', 'users'));
    }

    public function store(StoreUserToRoleRequest $request)
    {
        $user = User::findOrFail($request->user);
        $user->assignRole($request->roles);
        return redirect()->route('assign.user.index')->with('success', 'User Berhasil Diberikan Role');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $users = User::all();
        $userRoles = $user->roles->pluck('id')->toArray(); // Mendapatkan id roles dari user yang sedang diedit
        return view('permissions.user.edit', compact('user', 'roles', 'users', 'userRoles'));
    }


    public function update(UpdateUserToRoleRequest $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('assign.user.index')->with('success', 'User Berhasil Diberikan Role');
    }
}
