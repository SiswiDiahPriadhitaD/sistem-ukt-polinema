<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\ProgramStudi;
use App\Models\KelompokUkt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function __construct()
    {
        // Set time and memory limit as needed
        set_time_limit(1000);
        ini_set('memory_limit', '512M');
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');
    }

    public function model(array $row)
    {
        // Get active period
        $periode = Periode::where('status_periode', 'aktif')->firstOrFail();

        // Split 'prodi' to get 'jenjang_pendidikan' and 'nama_program_studi'

        $jurusan = $row['jurusan'];
        $jurusanData = Jurusan::where('nama_jurusan', $jurusan)->first();
        $prodiParts = explode(' ', $row['prodi'], 2);
        $jenjangPendidikan = $prodiParts[0];
        $namaProgramStudi = $prodiParts[1];

        // Get program studi
        $programStudi = ProgramStudi::where('id_jurusan', $jurusanData->id)
            ->where('jenjang_pendidikan', $jenjangPendidikan)
            ->where('nama_program_studi', $namaProgramStudi)
            ->first();

        if (is_null($programStudi)) {
            // Log an error or handle this case appropriately
            return null;
        }
        if (is_null($programStudi)) {
            // Log an error or handle this case appropriately
            return null;
        }

        // Get kelompok UKT
        $kelompokUkt = KelompokUkt::where('id_program_studi', $programStudi->id)
            ->where('nama_kelompok_ukt', $row['kelompok_ukt'])
            ->first();

        // Check if the user already exists
        $user = User::where('username', $row['nim'])->first();

        if (!$user) {
            // Create a new user if it doesn't exist
            $user = User::create(
                [
                    'name' => $row['nama'],
                    'username' => $row['nim'],
                    'password' => Hash::make($row['nim']),
                    'email_verified_at' => now(),
                ]
            );

            // Assign role to the user
            $user->assignRole('mahasiswa');
        } else {
            // Optionally, you can update the user if they already exist
            $user->update(
                [
                    'name' => $row['nama'],
                    'password' => Hash::make($row['nim']),
                    'email_verified_at' => now(),
                ]
            );

            // Ensure the user has the correct role
            if (!$user->hasRole('mahasiswa')) {
                $user->assignRole('mahasiswa');
            }
        }


        // Create or update mahasiswa
        return Mahasiswa::updateOrCreate(
            ['nim_mahasiswa' => $row['nim']],
            [
                'id_user' => $user->id,
                'nama_mahasiswa' => $row['nama'],
                'angkatan_mahasiswa' => $row['angkatan'],
                'semester_mahasiswa' => $row['semester'],
                'jenjang_mahasiswa' => $row['jenjang'],
                'id_program_studi' => $programStudi->id,
                'jalur_masuk' => $row['jalur_masuk'],
                'alamat_ortu' => $row['alamat_ortu'],
                'no_hp_aktif' => $row['no_hp_aktif'],
                'no_telp_ayah' => $row['no_telp_ayah'],
                'status_ortu' => $row['status_ortu'],
                'pekerjaan_ayah' => $row['pekerjaan_ayah'],
                'pekerjaan_ibu' => $row['pekerjaan_ibu'],
                'jml_tanggungan' => $row['jml_tanggungan'],
                'anak_di_tanggung' => $row['anak_di_tanggung'],
                'penghasilan_ayah' => $row['penghasilan_ayah'],
                'penghasilan_ibu' => $row['penghasilan_ibu'],
                'penghasilan_gabungan' => $row['penghasilan_gabungan'],
                'besaran_pdam' => $row['air'],
                'besaran_pln' => $row['listrik'],
                'pajak_mobil' => $row['pajak_mobil'],
                'pajak_motor' => $row['pajak_motor'],
                'id_kelompok_ukt' => $kelompokUkt->id ?? null,
                'status_verifikasi' => 'Pending',
                'id_periode' => $periode->id,
                'histori_pengajuan_mahasiswa' => $row['histori_pengajuan_mahasiswa'] ?? null,
                'foto_mahasiswa' => $row['foto_mahasiswa'] ?? null,
                'foto_pekerjaan_ayah' => $row['foto_pekerjaan_ayah'] ?? null,
                'foto_pekerjaan_ibu' => $row['foto_pekerjaan_ibu'] ?? null,
                'foto_keluarga' => $row['foto_keluarga'] ?? null,
                'foto_penghasilan_ayah' => $row['foto_penghasilan_ayah'] ?? null,
                'foto_penghasilan_ibu' => $row['foto_penghasilan_ibu'] ?? null,
                'foto_penghasilan_gabungan' => $row['foto_penghasilan_gabungan'] ?? null,
                'foto_pembayaran_pln' => $row['foto_pembayaran_pln'] ?? null,
                'foto_pembayaran_pdam' => $row['foto_pembayaran_pdam'] ?? null,
                'foto_pajak_mobil' => $row['foto_pajak_mobil'] ?? null,
                'foto_pajak_motor' => $row['foto_pajak_motor'] ?? null,
                'status_verifikasi' => 'Diverifikasi',
            ]
        );
    }


    // public function uniqueBy()
    // {
    //     return 'nim';
    // }
}
