<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'parent_id', 'image', 'is_featured', 'is_active', 'position', 'clicks'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function parentCategory() {
        return $this->belongsTo(ProductCategory::class, 'parent_id')->withTrashed();
    }
    public function subCategories() {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
    public function products() {
        return $this->hasMany(Product::class, 'category_id');
    }
}
