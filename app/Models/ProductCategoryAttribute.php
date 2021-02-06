<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class ProductCategoryAttribute extends Model
{

    protected $fillable = [
        'attribute_id', 'category_id'
    ];

    public function ProductCategory() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function Attributes() {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }


}
