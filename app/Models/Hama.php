<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hama extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_msthama';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_hama';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

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
        'nama_hama',
        'id_sublayanan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_hama' => 'integer',
        'nama_hama' => 'string',
        'id_sublayanan' => 'integer',
    ];

    /**
     * Get the sublayanan that owns the hama.
     */
    public function sublayanan()
    {
        return $this->belongsTo(SubLayanan::class, 'id_sublayanan', 'id_sublayanan');
    }
}