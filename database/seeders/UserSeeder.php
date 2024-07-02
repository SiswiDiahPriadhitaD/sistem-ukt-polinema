<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('sql/user.sql');
        $sql = File::get($path);
        DB::unprepared($sql);
        // User::create([
        //     'name' => "SuperAdmin",
        //     'username' => "superadmin",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "user",
        //     'username' => "user",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "wadir",
        //     'username' => "wadir",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "mahasiswa",
        //     'username' => "mahasiswa",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "DERRICK NAABIH PRABASWARA SAPUTRA",
        //     'username' => "2142520220",
        //     'password' => Hash::make('2142520220'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "DIAN RAHAYU",
        //     'username' => "1931110017",
        //     'password' => Hash::make('1931110017'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "GALUH RASMI RAMANI",
        //     'username' => "1941160083",
        //     'password' => Hash::make('1941160083'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "GILBERT PRATHAMA PAJUK",
        //     'username' => "1942520045",
        //     'password' => Hash::make('1942520045'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "GAYATRI ANINGTYAS",
        //     'username' => "1941320137",
        //     'password' => Hash::make('1941320137'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "DILA SHOFIYANA",
        //     'username' => "2042530047",
        //     'password' => Hash::make('2042530047'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "DINA WAHYU SAFITRI",
        //     'username' => "2142530062",
        //     'password' => Hash::make('2142530062'),
        //     'email_verified_at' => now(),

        // ]);
        // User::create([
        //     'name' => "ELSIANA DEWI",
        //     'username' => "2042520115",
        //     'password' => Hash::make('2042520115'),
        //     'email_verified_at' => now(),

        // ]);
        // User::create([
        //     'name' => "ESTIAN",
        //     'username' => "1942530005",
        //     'password' => Hash::make('1942530005'),
        //     'email_verified_at' => now(),

        // ]);
    }
}