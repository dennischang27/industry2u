<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = [
        'name', 'is_active'
    ];

    public function companies() {
        return $this->hasMany(Company::class, 'brand_id');
    }
}
