<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    protected $fillable = [
        'name', 'file_path', 'page_to', 'page_from', 'product_id'
    ];

}
