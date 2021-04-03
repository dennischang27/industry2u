<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WantedLists extends Model
{
    protected $fillable = [
        'product_id','product_name','supplier_company_id','supplier_company_name','product_slug','product_filepath',
        'quantity','brand_id','purchaser_company_id','user_id','status','remark'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function requestBy() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
