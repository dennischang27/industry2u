<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'descriptions','series_no','slug','image', 'value','position','is_featured',
        'is_active','status', 'views','company_id','brand_id','category_id'
    ];
}
