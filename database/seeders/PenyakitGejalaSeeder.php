<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenyakitGejala;

class PenyakitGejalaSeeder extends Seeder
{
    public function run()
    {
        $penyakit_gejala = [
            // Canine Parvovirus
            ['id_penyakit' => 1, 'id_gejala' => 1], // Loss of appetite
            ['id_penyakit' => 1, 'id_gejala' => 2], // Vomiting
            ['id_penyakit' => 1, 'id_gejala' => 4], // Diarrhea
            ['id_penyakit' => 1, 'id_gejala' => 5], // Lethargy

            // Kennel Cough
            ['id_penyakit' => 2, 'id_gejala' => 3], // Coughing
            ['id_penyakit' => 2, 'id_gejala' => 6], // Fever
            ['id_penyakit' => 2, 'id_gejala' => 8], // Nasal discharge
            ['id_penyakit' => 2, 'id_gejala' => 9], // Eye discharge

            // Distemper
            ['id_penyakit' => 3, 'id_gejala' => 1], // Loss of appetite
            ['id_penyakit' => 3, 'id_gejala' => 3], // Coughing
            ['id_penyakit' => 3, 'id_gejala' => 4], // Diarrhea
            ['id_penyakit' => 3, 'id_gejala' => 7], // Weight loss
            ['id_penyakit' => 3, 'id_gejala' => 10], // Difficulty breathing

            // Lyme Disease
            ['id_penyakit' => 4, 'id_gejala' => 5], // Lethargy
            ['id_penyakit' => 4, 'id_gejala' => 13], // Lameness
            ['id_penyakit' => 4, 'id_gejala' => 12], // Swollen lymph nodes
            ['id_penyakit' => 4, 'id_gejala' => 11], // Abdominal pain

            // Heartworm
            ['id_penyakit' => 5, 'id_gejala' => 1], // Loss of appetite
            ['id_penyakit' => 5, 'id_gejala' => 2], // Vomiting
            ['id_penyakit' => 5, 'id_gejala' => 10], // Difficulty breathing
            ['id_penyakit' => 5, 'id_gejala' => 19], // Excessive drooling
        ];

        foreach ($penyakit_gejala as $pg) {
            PenyakitGejala::create($pg);
        }
    }
}
