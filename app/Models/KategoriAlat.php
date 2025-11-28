<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAlat extends Model
{
    use HasFactory;

    protected $table = 'app_mstkategorialat';
    protected $primaryKey = 'kodekategori';
    public $timestamps = false;

    protected $fillable = [
        'namakategori',
        'keterangan'
    ];
}