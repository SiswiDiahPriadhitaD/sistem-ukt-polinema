<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gejala;

class GejalaSeeder extends Seeder
{
    public function run()
    {
        $gejala = [
            ['kode_gejala' => 'G001', 'nama_gejala' => 'Loss of appetite', 'keterangan' => 'Dog refuses to eat or shows disinterest in food'],
            ['kode_gejala' => 'G002', 'nama_gejala' => 'Vomiting', 'keterangan' => 'Dog vomits frequently'],
            ['kode_gejala' => 'G003', 'nama_gejala' => 'Coughing', 'keterangan' => 'Dog has a persistent cough'],
            ['kode_gejala' => 'G004', 'nama_gejala' => 'Diarrhea', 'keterangan' => 'Dog has loose or watery stools'],
            ['kode_gejala' => 'G005', 'nama_gejala' => 'Lethargy', 'keterangan' => 'Dog shows signs of extreme tiredness or lack of energy'],
            ['kode_gejala' => 'G006', 'nama_gejala' => 'Fever', 'keterangan' => 'Dog has an elevated body temperature'],
            ['kode_gejala' => 'G007', 'nama_gejala' => 'Weight loss', 'keterangan' => 'Dog loses weight rapidly'],
            ['kode_gejala' => 'G008', 'nama_gejala' => 'Nasal discharge', 'keterangan' => 'Dog has a runny nose'],
            ['kode_gejala' => 'G009', 'nama_gejala' => 'Eye discharge', 'keterangan' => 'Dog has discharge from the eyes'],
            ['kode_gejala' => 'G010', 'nama_gejala' => 'Difficulty breathing', 'keterangan' => 'Dog has trouble breathing or breathes rapidly'],
            ['kode_gejala' => 'G011', 'nama_gejala' => 'Abdominal pain', 'keterangan' => 'Dog shows signs of stomach pain'],
            ['kode_gejala' => 'G012', 'nama_gejala' => 'Swollen lymph nodes', 'keterangan' => 'Dog has swollen glands'],
            ['kode_gejala' => 'G013', 'nama_gejala' => 'Lameness', 'keterangan' => 'Dog shows signs of difficulty walking'],
            ['kode_gejala' => 'G014', 'nama_gejala' => 'Seizures', 'keterangan' => 'Dog has convulsions or fits'],
            ['kode_gejala' => 'G015', 'nama_gejala' => 'Jaundice', 'keterangan' => 'Dog has yellowing of the skin or eyes'],
            ['kode_gejala' => 'G016', 'nama_gejala' => 'Bloody stool', 'keterangan' => 'Dog has blood in its stool'],
            ['kode_gejala' => 'G017', 'nama_gejala' => 'Persistent itching', 'keterangan' => 'Dog itches or scratches persistently'],
            ['kode_gejala' => 'G018', 'nama_gejala' => 'Hair loss', 'keterangan' => 'Dog loses patches of hair'],
            ['kode_gejala' => 'G019', 'nama_gejala' => 'Excessive drooling', 'keterangan' => 'Dog drools excessively'],
            ['kode_gejala' => 'G020', 'nama_gejala' => 'Behavioral changes', 'keterangan' => 'Dog exhibits unusual behavior']
        ];

        foreach ($gejala as $g) {
            Gejala::create($g);
        }
    }
}
