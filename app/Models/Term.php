<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'code','description', 'days','company_id'
    ];
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
