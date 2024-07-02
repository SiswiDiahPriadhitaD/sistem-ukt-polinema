<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $fillable = [
        'id_jurusan',
        'nama_program_studi',
        'jenjang_pendidikan',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($table) {
            $table->created_by = auth()->user()->id;
        });
        self::updating(function ($table) {
            $table->updated_by = auth()->user()->id;
        });
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function kelompokUkt()
    {
        return $this->hasMany(KelompokUkt::class, 'id_program_studi');
    }
}
