<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JumlahPendapatanOrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jumlah_pendapatan_orang_tua')->insert([
            [
                'nama_kriteria' => '> 450.000',
                'nilai_kriteria' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '301.000 <= n <= 450.000',
                'nilai_kriteria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '150.000 <= n <= 300.000',
                'nilai_kriteria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '0 <= n <= 150.000',
                'nilai_kriteria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
