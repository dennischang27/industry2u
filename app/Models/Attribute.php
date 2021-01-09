<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $fillable = [
        'id', 'name', 'slug', 'type', 'position',
        'position',  'is_range', 'is_unique', 'is_required', 'is_filterable', 'is_configurable',
        'is_active', 'attribute_group_id'
    ];

    public function group() {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }
}
