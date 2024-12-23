<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuotaUnidad extends Model
{
    use HasFactory;

    protected $table = 'cuotas_unidad';

    protected $fillable = [
        'cuota_ph_id',
        'unidad_id',
    ];

    public function cuotaPH()
    {
        return $this->belongsTo(CuotaPH::class, 'cuotas_ph_id');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}