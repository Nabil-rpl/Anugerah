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

    /**
     * Get the hama for the sublayanan.
     */
    public function hama()
    {
        return $this->hasMany(Hama::class, 'id_sublayanan', 'id_sublayanan');
    }
    
    /**
     * Get the jenis layanan that owns the sublayanan.
     */
    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_layanan', 'id_jenislayanan');
    }
}