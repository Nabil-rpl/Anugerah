<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'kode_kecamatan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_kecamatan',
        'kode_kota',
        'nama_kecamatan'
    ];

    protected $casts = [
        'kode_kecamatan' => 'string',
        'kode_kota' => 'string',
        'nama_kecamatan' => 'string',
    ];

    // Relasi ke Kota
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kode_kota', 'kode_kota');
    }
}