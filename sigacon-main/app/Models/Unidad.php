<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    // Si la tabla tiene un nombre diferente al plural del modelo, especifica el nombre de la tabla
    protected $table = 'unidades';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'tipoUnidad',
        'torreBloque',
        'number',
        'matriculaInmobiliaria',
        'fichaCatastral',
        'areaMt2',
        'propietario',
        'garaje',
        'porcentajeUnidad',
        'totalCoeficiente',
        'empresa_id', // Este es el campo de la clave foránea
    ];

    /**
     * Relación uno a muchos con Empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * Relación con CuotaUnidad
     */
        public function cuotasUnidad()
    {
        return $this->hasMany(CuotaUnidad::class);
    }

    
}
