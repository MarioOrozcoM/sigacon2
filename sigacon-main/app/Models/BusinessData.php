<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessData extends Model
{

    protected $table = 'business_data';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
