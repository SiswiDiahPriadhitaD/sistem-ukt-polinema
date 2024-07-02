<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::create([
            'nama_periode' => 'Semester Genap',
            'tanggal_mulai_periode' => '2024-06-04 15:37:37',
            'tanggal_akhir_periode' => '2024-06-04 15:37:37',
            'status_periode' => 'Aktif',
        ]);

        Periode::create([
            'nama_periode' => 'Semester Ganjil',
            'tanggal_mulai_periode' => '2024-06-04 15:37:37',
            'tanggal_akhir_periode' => '2024-06-04 15:37:37',
            'status_periode' => 'Tidak Aktif',
        ]);
    }
}
