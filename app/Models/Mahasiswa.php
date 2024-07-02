<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'id_user',
        'nama_mahasiswa',
        'nim_mahasiswa',
        'angkatan_mahasiswa',
        'semester_mahasiswa',
        'jenjang_mahasiswa',
        'id_program_studi',
        'jalur_masuk',
        'alamat_ortu',
        'no_hp_aktif',
        'no_telp_ayah',
        'status_ortu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'jml_tanggungan',
        'anak_di_tanggung',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'penghasilan_gabungan',
        'besaran_pdam',
        'besaran_pln',
        'pajak_mobil',
        'pajak_motor',
        'id_kelompok_ukt',
        'id_kelompok_ukt_baru',
        'status_verifikasi',
        'status_verifikasi_perhitungan',
        'histori_pengajuan_mahasiswa',
        'id_periode',
        'histori_pengajuan_mahasisswa',
        'foto_mahasiswa',
        'foto_pekerjaan_ayah',
        'foto_pekerjaan_ibu',
        'foto_keluarga',
        'foto_penghasilan_ayah',
        'foto_penghasilan_ibu',
        'foto_penghasilan_gabungan',
        'foto_pembayaran_pln',
        'foto_pembayaran_pdam',
        'foto_pajak_mobil',
        'foto_pajak_motor',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_studi', 'id');
    }

    public function kelompokUkt()
    {
        return $this->belongsTo(KelompokUkt::class, 'id_kelompok_ukt', 'id');
    }

    public function kelompokUktBaru()
    {
        return $this->belongsTo(KelompokUkt::class, 'id_kelompok_ukt_baru', 'id');
    }


    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}
