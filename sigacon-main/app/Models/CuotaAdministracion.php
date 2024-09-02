<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuotaAdministracion extends Model
{
    use HasFactory;

    protected $table = 'cuota_administracion';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'cuotaMensual1',
        'cuotaMensual1SinDescuento',
        'descuento',
        'cuotaMensual2Descuento',
        'diferenciaMensualIncremento',
        'valorRetroactivo',
        'totalPagarSinDescuento',
        'unidad_id', // Este es el campo de la clave foránea
    ];

    /**
     * Relación uno a uno con Unidad
     */
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
