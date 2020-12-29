<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    protected $fillable = [
        'name', 'input_name', 'type', 'position', 'is_active'
    ];
}
