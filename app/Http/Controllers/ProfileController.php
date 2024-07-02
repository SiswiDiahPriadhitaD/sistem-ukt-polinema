<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request, $id)
    {
        try {
            $data = $request->only(['no_hp', 'alamat', 'jenis_kelamin']);

            Profile::updateOrCreate(
                ['id_user' => $id],
                $data
            );

            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('profile.index')->with('error', 'Terjadi kesalahan saat memperbarui profil');
        }
    }
}
