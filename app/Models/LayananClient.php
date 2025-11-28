<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananClient extends Model
{
    use HasFactory;

    protected $table = 'layanan_client';
    
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];
}