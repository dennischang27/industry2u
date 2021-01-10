<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'id','value', 'product_id','attribute_id','attribute_measurement_id'
    ];
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function attribute_measurement() {
        return $this->belongsTo(AttributeMeasurement::class);
    }

}
