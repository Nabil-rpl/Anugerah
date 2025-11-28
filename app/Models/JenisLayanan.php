<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    protected $table = 'app_mstjenislayanan';
    protected $primaryKey = 'id_jenislayanan';
    public $timestamps = false;
    public $incrementing = false; // ← Ubah jadi false karena manual input
    protected $keyType = 'integer'; // ← Tambahkan ini

    protected $fillable = [
        'id_jenislayanan', // ← Tambahkan ini
        'nama_layanan',
    ];
}