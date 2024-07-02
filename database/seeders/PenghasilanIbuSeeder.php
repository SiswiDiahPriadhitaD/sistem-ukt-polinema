<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenghasilanIbuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penghasilan_ibu')->insert([
            [
                'nama_kriteria' => '> 2 Juta',
                'nilai_kriteria' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '1.5 juta <= n <= 2 Juta',
                'nilai_kriteria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => '500.000 <= n <= 1.5 Juta',
                'nilai_kriteria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => 'TIDAK BERPENGHASILAN',
                'nilai_kriteria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
