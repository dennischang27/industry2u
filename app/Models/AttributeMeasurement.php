<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeMeasurement extends Model
{
    protected $fillable = [
         'id','name', 'min', 'max','position','is_active','attribute_id'
    ];
    public function attributes() {
            return $this->belongsTo(Attributes::class, 'attribute_id');
    }
}
