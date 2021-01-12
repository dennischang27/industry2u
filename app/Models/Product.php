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
        'name', 'description','series_no','slug','image', 'value','position','is_featured','price',
        'is_active','status', 'views','company_id','brand_id','category_id','user_id'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function productImage() {
        return $this->hasMany(ProductImage::class);
    }

    public function productAttachment() {
        return $this->hasMany(ProductAttachment::class);
    }

    public function productAttribute() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class);
    }


}
