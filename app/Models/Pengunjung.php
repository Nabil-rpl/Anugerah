<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';
    protected $primaryKey = 'id_pengunjung';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'alamat_lengkap',
        'kode_provinsi',
        'kode_kota',
        'kode_kecamatan',
        'kode_kelurahan',
        'email',
        'nomor_telepon',
        'pesan',
        'waktu',
        'lokasi_pengisi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'waktu' => 'datetime',
    ];
}