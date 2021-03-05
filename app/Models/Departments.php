<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    public $table = "departments";

    protected $fillable = [
        'name'
    ];
}
