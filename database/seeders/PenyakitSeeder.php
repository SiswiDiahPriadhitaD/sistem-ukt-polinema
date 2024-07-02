<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    public function run()
    {
        Penyakit::create([
            'nama_penyakit' => 'Canine Parvovirus',
            'detail_penyakit' => 'A highly contagious viral disease that can produce a life-threatening illness.',
            'penyebab_penyakit' => 'Parvovirus infection',
            'penanganan_penyakit' => 'Supportive care, including fluid therapy and medications',
        ]);

        Penyakit::create([
            'nama_penyakit' => 'Kennel Cough',
            'detail_penyakit' => 'A complex of infections, both viral and bacterial, that causes inflammation of a dog’s voice box and windpipe.',
            'penyebab_penyakit' => 'Bordetella bronchiseptica',
            'penanganan_penyakit' => 'Antibiotics and cough suppressants',
        ]);

        Penyakit::create([
            'nama_penyakit' => 'Distemper',
            'detail_penyakit' => 'A viral disease that affects a dog’s respiratory, gastrointestinal and central nervous systems.',
            'penyebab_penyakit' => 'Canine distemper virus',
            'penanganan_penyakit' => 'Supportive care, including fluid therapy and medications',
        ]);

        Penyakit::create([
            'nama_penyakit' => 'Lyme Disease',
            'detail_penyakit' => 'An infectious disease caused by Borrelia bacteria, spread by ticks.',
            'penyebab_penyakit' => 'Borrelia burgdorferi',
            'penanganan_penyakit' => 'Antibiotics',
        ]);

        Penyakit::create([
            'nama_penyakit' => 'Heartworm',
            'detail_penyakit' => 'A serious disease caused by foot-long worms that live in the heart, lungs and associated blood vessels of affected pets.',
            'penyebab_penyakit' => 'Dirofilaria immitis',
            'penanganan_penyakit' => 'Medications to kill the worms',
        ]);
    }
}
