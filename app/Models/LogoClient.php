<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoClient extends Model
{
    use HasFactory;

    protected $table = 'logo_client';
    
    public $timestamps = false;
    
    protected $fillable = [
        'nama_perusahaan',
        'gambar_logo',
        'waktu'
    ];

    protected $casts = [
        'id' => 'integer',
        'waktu' => 'datetime',
    ];
}