<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuotaUnidad extends Model
{
    use HasFactory;
    protected $table = 'cuota_unidad';

    protected $fillable = [
        'cuota_administracion_id',
        'unidad_id',
        //'monto',
    ];

    public function cuotaAdministracion()
    {
        return $this->belongsTo(CuotaAdministracion::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
