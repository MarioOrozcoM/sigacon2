<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuotaPH extends Model
{
    use HasFactory;

    protected $table = 'cuotas_ph';

    protected $fillable = [
        'vrlIndividual',
        'tipo',
        'aNombreDe',
        'desde',
        'hasta',
        'observacion',
        'concepto_id',
    ];

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function unidades()
    {
        return $this->hasMany(CuotaUnidad::class);
    }
}