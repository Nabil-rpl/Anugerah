<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kota';
    protected $primaryKey = 'kode_kota';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_kota',
        'kode_provinsi',
        'nama_kota'
    ];

    protected $casts = [
        'kode_kota' => 'string',
        'kode_provinsi' => 'string',
        'nama_kota' => 'string',
    ];

    // Relasi ke Provinsi (jika ada model Provinsi)
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_provinsi', 'kode_provinsi');
    }

    // Relasi ke Kecamatan
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kode_kota', 'kode_kota');
    }
}