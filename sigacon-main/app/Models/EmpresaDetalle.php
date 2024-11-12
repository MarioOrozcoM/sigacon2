<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaDetalle extends Model
{
    use HasFactory;

    protected $table = 'empresa_detalles';

    protected $fillable = [
        'correo_factura',
        'cuenta_banco',
        'empresa_id', // Este campo será la clave foránea para la relación
    ];

    // Relación con el modelo Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}