<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubLayanan extends Model
{
    protected $table = 'app_mstsublayanan';
    protected $primaryKey = 'id_sublayanan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama_sublayanan',
        'id_layanan',
    ];

    protected $casts = [
        'id_sublayanan' => 'integer',
        'id_layanan' => 'integer',
        'nama_sublayanan' => 'string',
    ];

    // COMMENT DULU JIKA TABEL LAYANAN BELUM ADA
    // /**
    //  * Get the layanan that owns the sublayanan.
    //  */
    // public function layanan()
    // {
    //     return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    // }

    /**
     * Get the hama for the sublayanan.
     */
    public function hama()
    {
        return $this->hasMany(Hama::class, 'id_sublayanan', 'id_sublayanan');
    }
}