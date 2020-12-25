<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','slug', 'descriptions','logo','status','is_featured','is_active','clicks'
    ];

    public function products() {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
