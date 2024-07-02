<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BesaranPajakKendaraanMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('besaran_pajak_kendaraan_mobil')->insert([
            [
                'nama_kriteria' => '> 2.000.000',
                'nilai_kriteria' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '1.500.000 <= n <= 2.000.000',
                'nilai_kriteria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '500.000 <= n <= 1.500.000',
                'nilai_kriteria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => 'TIDAK PUNYA',
                'nilai_kriteria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
