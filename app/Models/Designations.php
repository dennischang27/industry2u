<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    //protected $table = 'designations';
    public $table = "designations";

    protected $fillable = [
        'name', 'roles_id'
    ];
}
