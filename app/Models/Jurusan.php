<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'nama_jurusan',
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

    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_jurusan');
    }
}
