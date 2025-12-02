<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hama extends Model
{
    use HasFactory;

    protected $table = 'app_msthama';
    protected $primaryKey = 'id_hama';
    public $timestamps = false;

    protected $fillable = [
        'nama_hama',
        'id_sublayanan'
    ];

    protected $casts = [
        'id_hama' => 'integer',
        'nama_hama' => 'string',
        'id_sublayanan' => 'integer',
    ];

    // Relasi ke SubLayanan
    public function sublayanan()
    {
        return $this->belongsTo(SubLayanan::class, 'id_sublayanan', 'id_sublayanan');
    }
}