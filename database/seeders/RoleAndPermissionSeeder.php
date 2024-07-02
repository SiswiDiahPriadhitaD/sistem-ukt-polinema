<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        Role::create(['name' => 'user']);
        Role::create(['name' => 'wadir']);
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'mahasiswa']);

        // Assign roles to specific users
        $user = User::find(1);
        if ($user) {
            $user->assignRole('super-admin');
        }

        $user = User::find(2);
        if ($user) {
            $user->assignRole('user');
        }

        $user = User::find(3);
        if ($user) {
            $user->assignRole('wadir');
        }

        // Create users 4-82 and assign role 'mahasiswa'
        for ($i = 4; $i <= 82; $i++) {
            $user = User::find($i);
            if ($user) {
                $user->assignRole('mahasiswa');
            }
        }
    }
}
