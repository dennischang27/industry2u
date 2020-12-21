<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $fillable = [
        'code', 'name', 'symbol','decimals','is_default','exchange_rate'
    ];
}
