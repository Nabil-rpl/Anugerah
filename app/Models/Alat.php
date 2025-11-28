<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'app_mstalat';
    protected $primaryKey = 'idalat';
    public $timestamps = false;

    protected $fillable = [
        'namaalat',
        'kodesatuan',
        'jumlah',
        'kodekategorialat',
        'keterangan',
        'waktu'
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Relasi ke Kategori Alat
    public function kategori()
    {
        return $this->belongsTo(KategoriAlat::class, 'kodekategorialat', 'kodekategori');
    }
}