<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'app_mst_client';
    
    protected $primaryKey = 'nomor_pelanggan';
    
    public $incrementing = false;
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'nomor_pelanggan',
        'nama_pelanggan',
        'alamat',
        'kode_provinsi',
        'kode_kota',
        'kode_kecamatan',
        'kode_kelurahan',
        'email',
        'nomor_telepon',
        'kontak',
        'nomor_kontak',
        'catatan',
        'waktu'
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    /**
     * Generate nomor pelanggan otomatis
     */
    public static function generateNomorPelanggan()
    {
        $lastClient = self::orderBy('nomor_pelanggan', 'desc')->first();
        
        if (!$lastClient) {
            return 'CLT0000001';
        }
        
        $lastNumber = (int) substr($lastClient->nomor_pelanggan, 3);
        $newNumber = $lastNumber + 1;
        
        return 'CLT' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
    }

    /**
     * Boot method untuk auto-generate nomor pelanggan
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->nomor_pelanggan)) {
                $model->nomor_pelanggan = self::generateNomorPelanggan();
            }
            if (empty($model->waktu)) {
                $model->waktu = now();
            }
        });
    }
}