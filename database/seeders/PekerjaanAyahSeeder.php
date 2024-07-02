<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanAyahSeeder extends Seeder
{
    public function run()
    {
        DB::table('pekerjaan_ayah')->insert([
            [
                'nama_kriteria' => 'PNS GOL.III-IV / BUMN/TNI-POLRI/ PEG.PERUSAHAAN/ WIRAUSAHA',
                'nilai_kriteria' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => 'PNS GOL.I-II / BUMN/TNI-POLRI/ PEG.PERUSAHAAN/ WIRAUSAHA',
                'nilai_kriteria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => 'TIDAK BEKERJA',
                'nilai_kriteria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'nama_kriteria' => 'YATIM',
                'nilai_kriteria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
