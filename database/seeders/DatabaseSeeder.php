<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            // PenyakitSeeder::class,
            // GejalaSeeder::class,
            // PenyakitGejalaSeeder::class,
            // KondisiSeeder::class,
            // AturanSeeder::class,

            //baru
            PekerjaanAyahSeeder::class,
            PekerjaanIbuSeeder::class,
            PenghasilanAyahSeeder::class,
            PenghasilanIbuSeeder::class,
            JumlahPendapatanOrangTuaSeeder::class,
            JumlahTanggunganSeeder::class,
            StatusOrangTuaSeeder::class,
            JumlahAnakSeeder::class,
            JumlahOrangTinggalSeeder::class,
            StatusKepemilikanRumahSeeder::class,
            BesaranPLNSeeder::class,
            BesaranPDAMSeeder::class,
            BesaranPajakKendaraanMobilSeeder::class,
            BesaranPajakKendaraanMotorSeeder::class,

            PeriodeSeeder::class,
            JurusanSeeder::class,
            ProgramStudiSeeder::class,
            KelompokUktSeeder::class,
            MahasiswaSeeder::class,


        ]);

        // User::factory(10)->create();
        // Mahasiswa::factory(10)->create();
    }
}
