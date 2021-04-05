<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationRequestDetails extends Model
{
    protected $fillable = [
        'name', 'product_name', 'product_id', 'brand_id', 'price', 'quantity', 'sku', 'discount_tier1',
        'discount_tier2', 'discount_tier3', 'total_discount', 'total_amount', 'qr_id'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
