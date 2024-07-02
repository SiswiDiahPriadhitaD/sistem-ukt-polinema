<?php

namespace App\Http\Controllers\Auth;

use App\DataTables\RoleDataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(RoleDataTables $dataTable)
    {
        return $dataTable->render('permissions.roles.index');
    }

    public function validateCreateRole(StoreRoleRequest $request)
    {
        return response()->json(['success' => true]);
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store(StoreRoleRequest $request)
    {

        $rules = (new StoreRoleRequest())->rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ]);
        }

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }


    public function edit(Role $role)
    {
        //tidak dipakai

    }

    public function validateUpdateRole(UpdateRoleRequest $request)
    {
        return response()->json(['success' => true]);
    }

    public function update(UpdateRoleRequest $request)
    {
        $validatedData = $request->validated();

        $role = Role::findOrFail($request->id);

        $existingRole = Role::where('name', $validatedData['name'])->first();
        if ($existingRole && $existingRole->id != $role->id) {
            return response()->json(['error' => true]);
        }

        $role->update($validatedData);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->users()->count() > 0) {
            return response()->json([
                'error' => true,
                'message' => 'Role tidak bisa dihapus karena sedang terpakai diuser.'
            ]);
        }

        try {
            $role->delete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus role.']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Permintaan tidak dapat di proses.']);
        }
    }
}
