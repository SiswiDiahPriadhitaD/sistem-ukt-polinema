<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanIbu extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_ibu';

    protected $fillable = [
        'nama_kriteria',
        'nilai_kriteria',
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
}