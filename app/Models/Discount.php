<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $fillable = [
        'master_tier1', 'master_tier2', 'master_tier3', 'manager_tier1', 'manager_tier2', 'manager_tier3',
        'sales_tier1', 'sales_tier2', 'sales_tier3', 'user_id'
    ];
}
