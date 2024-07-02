<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTables;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(UserDataTables $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }


    public function validateCreateUser(StoreUserRequest $request)
    {
        return response()->json(['success' => true]);
    }

    public function store(StoreUserRequest $request)
    {
        $rules = (new StoreUserRequest())->rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ]);
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username, // Ubah dari 'email' menjadi 'username'
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit(User $user)
    {
        //tidak dipakai
    }

    public function validateUpdateUser(UpdateUserRequest $request)
    {
        return response()->json(['success' => true]);
    }
    public function update(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();

        $existingUser = User::where('username', $validatedData['username'])->first();
        if ($existingUser && $existingUser->id != $request->id) {
            return response()->json(['error' => true]);
        }

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user = User::findOrFail($request->id);
        $user->update($validatedData);

        return response()->json(['success' => true]);
    }

    public function destroy(User $user)
    {
        //tidak dipakai
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deactivated successfully.']);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return response()->json(['success' => true, 'message' => 'User restored successfully.']);
    }
}
