<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'first_lastname',
        'second_lastname',
        'email',
        'password',
        'rol',
        'document_type',
        'identification_number',
        'social_reason',
        'trade_name',
        'physical_address',
        'phone',
        'cellphone',
        'autoretenedor_renta',
        'autoretenedor_iva',
        'autoretenedor_ica',
        'responsable_iva',
        'declarante_rsts',
        'declarante_renta',
        'country_id',
        'state_id',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Actualiza la contraseña del usuario.
     *
     * @param  string  $password
     * @return bool
     */
    public function updatePassword($password)
    {
        $this->password = Hash::make($password);
        return $this->save();
    }

    public function businessData()
    {
        return $this->hasOne(BusinessData::class);
    }
    

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}



