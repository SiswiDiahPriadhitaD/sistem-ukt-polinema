<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KondisiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_kondisi' => 'Sangat Pasti', 'nilai_kondisi' => 0.99],
            ['nama_kondisi' => 'Pasti', 'nilai_kondisi' => 0.90],
            ['nama_kondisi' => 'Kemungkinan Besar', 'nilai_kondisi' => 0.75],
            ['nama_kondisi' => 'Mungkin', 'nilai_kondisi' => 0.50],
            ['nama_kondisi' => 'Tidak Pasti', 'nilai_kondisi' => 0.25],
            ['nama_kondisi' => 'Sangat Tidak Pasti', 'nilai_kondisi' => 0.10],
            ['nama_kondisi' => 'Tidak Yakin', 'nilai_kondisi' => 0.01],
        ];

        DB::table('kondisi')->insert($data);
    }
}
