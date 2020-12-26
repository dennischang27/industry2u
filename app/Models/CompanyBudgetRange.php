<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyBudgetRange extends Model
{
    protected $fillable = [
        'name',  'from', 'to'
    ];
}
