<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aturan;
use App\Models\PenyakitGejala;
use Illuminate\Support\Facades\DB;

class AturanSeeder extends Seeder
{
    public function run()
    {
        $penyakit_gejala = PenyakitGejala::all();

        // Mapping penyakit_gejala to rules (mb and md values)
        $aturan = [
            // Canine Parvovirus
            1 => [
                1 => ['mb' => 0.8, 'md' => 0.1], // Loss of appetite
                2 => ['mb' => 0.9, 'md' => 0.2], // Vomiting
                4 => ['mb' => 0.85, 'md' => 0.15], // Diarrhea
                5 => ['mb' => 0.75, 'md' => 0.1], // Lethargy
            ],
            // Kennel Cough
            2 => [
                3 => ['mb' => 0.7, 'md' => 0.1], // Coughing
                6 => ['mb' => 0.6, 'md' => 0.1], // Fever
                8 => ['mb' => 0.65, 'md' => 0.1], // Nasal discharge
                9 => ['mb' => 0.6, 'md' => 0.05], // Eye discharge
            ],
            // Distemper
            3 => [
                1 => ['mb' => 0.7, 'md' => 0.2], // Loss of appetite
                3 => ['mb' => 0.75, 'md' => 0.2], // Coughing
                4 => ['mb' => 0.8, 'md' => 0.3], // Diarrhea
                7 => ['mb' => 0.85, 'md' => 0.25], // Weight loss
                10 => ['mb' => 0.9, 'md' => 0.2], // Difficulty breathing
            ],
            // Lyme Disease
            4 => [
                5 => ['mb' => 0.8, 'md' => 0.4], // Lethargy
                13 => ['mb' => 0.75, 'md' => 0.35], // Lameness
                12 => ['mb' => 0.65, 'md' => 0.2], // Swollen lymph nodes
                11 => ['mb' => 0.7, 'md' => 0.25], // Abdominal pain
            ],
            // Heartworm
            5 => [
                1 => ['mb' => 0.9, 'md' => 0.2], // Loss of appetite
                2 => ['mb' => 0.85, 'md' => 0.3], // Vomiting
                10 => ['mb' => 0.95, 'md' => 0.25], // Difficulty breathing
                19 => ['mb' => 0.7, 'md' => 0.1], // Excessive drooling
            ],
        ];

        foreach ($penyakit_gejala as $pg) {
            $id_penyakit = $pg->id_penyakit;
            $id_gejala = $pg->id_gejala;

            if (isset($aturan[$id_penyakit][$id_gejala])) {
                $rule = $aturan[$id_penyakit][$id_gejala];

                Aturan::create([
                    'id_penyakit' => $id_penyakit,
                    'id_gejala' => $id_gejala,
                    'mb' => $rule['mb'],
                    'md' => $rule['md']
                ]);
            }
        }
    }
}
