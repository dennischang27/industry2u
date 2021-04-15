<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    //
    protected $fillable = [

        'user_id',
        'company_id',
        'discount_tier1',
        'discount_tier2', 
        'discount_tier3', 
        'total_discount',
        'category_id',
        'subcategory_id',
        'product_id'
    ];
  
}
