<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = [
        'id', 'name', 'slug', 'image','position','status','is_active'
    ];
    public function attributes() {
        return $this->hasMany(Attribute::class, 'attribute_group_id');
    }
}
