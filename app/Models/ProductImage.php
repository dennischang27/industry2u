<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $fillable = [
        'name', 'path', 'position', 'product_id', 'is_cover', 'is_active', 'position'
    ];
    public function products() {
        return $this->hasMany(Product::class, 'product_id');
    }
}
