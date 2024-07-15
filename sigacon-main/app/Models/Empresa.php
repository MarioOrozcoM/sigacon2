<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';


    protected $fillable = [
        'codigo_empresa',
        'tipo_empresa',
        'numero_identificacion',
        'persona_juridica',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'razon_social',
        'nombre_comercial',
        'numero_identificacion_repre',
        'fecha_inicio_repre',
        'numero_acta_repre',
        'numero_identificacion_suplente',
        'fecha_inicio_suplente',
        'numero_acta_suplente',
        'numero_identificacion_contador',
        'fecha_inicio_contador',
        'tarjeta_profesional_contador',
        'numero_identificacion_revisor',
        'fecha_inicio_revisor',
        'tarjeta_profesional_revisor',
        'numero_acta_revisor',
        'numero_identificacion_socio',
        'fecha_registro_socio',
        'numero_acciones',
        'numero_titulo',
        'numero_resolucion',
        'fecha_resolucion',
        'rangos_numeracion',
        'observaciones',
        'logo',
        'tamano_empresa',

    ];
    

}
