<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelurahan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'kode_kelurahan';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_kelurahan',
        'kode_kecamatan',
        'nama_kelurahan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'kode_kelurahan' => 'string',
        'kode_kecamatan' => 'string',
        'nama_kelurahan' => 'string',
    ];

    /**
     * Get the kecamatan that owns the kelurahan.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kecamatan', 'kode_kecamatan');
    }
}