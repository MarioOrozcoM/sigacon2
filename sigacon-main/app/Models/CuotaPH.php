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
        return $this->belongsTo(Concepto::class, 'concepto_id');
    }

    public function unidades()
    {
        return $this->belongsToMany(Unidad::class, 'cuotas_unidad', 'cuotas_ph_id', 'unidad_id');
    }    

        public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}