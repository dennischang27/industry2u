<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{

    protected $fillable = [
        'name', 'country_id' ,'code','name', 'country_code'
    ];
}
