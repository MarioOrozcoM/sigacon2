<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;
use App\Models\City;


class State extends Model
{

    // Nombre de la tabla en la base de datos
    protected $table = 'states';

    // Columna que representa la clave primaria en la tabla
    protected $primaryKey = 'id';

    // Indica si las columnas de tiempo de creación y actualización están activadas
    public $timestamps = false;

    // Lista de atributos que se pueden asignar en masa
    protected $fillable = [
        'name', // Asegúrate de tener este campo en tu tabla
        // Agrega aquí otros campos que desees asignar en masa
    ];

    // Relación inversa: un estado tiene muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
