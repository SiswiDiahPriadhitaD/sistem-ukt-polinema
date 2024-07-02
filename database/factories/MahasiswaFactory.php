<?php

namespace Database\Factories;


use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition()
    {
        $programStudi = ProgramStudi::inRandomOrder()->first();
        $jenjang = $programStudi->jenjang_pendidikan === 'D3' ? 'E' : 'D';
        $user = User::factory()->create();

        return [
            'id_user' => $user->id,
            'nama_mahasiswa' => $user->name,
            'nim_mahasiswa' => $user->email,
            'angkatan_mahasiswa' => $this->faker->year,
            'semester_mahasiswa' => $this->faker->numberBetween(1, 8),
            'jenjang_mahasiswa' => $jenjang,
            'id_program_studi' => $programStudi->id,
            'jalur_masuk' => $this->faker->randomElement(['PSB/PMDK/SNMPN/SNMPTN', 'UMPN PSDKU', 'UMPN/SBMPN/SBMPTN', 'Mandiri']),
            'id_periode' => 1,
            'status_verifikasi' => 'Diverifikasi',
        ];
    }
}