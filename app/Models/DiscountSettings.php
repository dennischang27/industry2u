<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountSettings extends Model
{
    //
    protected $fillable = [
        'user_id',
        'company_id',
        'is_master',
        'discount_tier1',
        'discount_tier2', 
        'discount_tier3', 
        'total_discount'
    ];
}
