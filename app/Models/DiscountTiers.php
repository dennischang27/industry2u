<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountTiers extends Model
{
    //
    protected $fillable = [
        'user_id',
        'discount_tier1',
        'discount_tier2',
        'discount_tier3',
        'company_id'
    ];  
}
