<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDoc extends Model
{
    protected $fillable = [
        'doc_type_id', 'file_path', 'company_id'
    ];
    public function doc_type() {
        return $this->belongsTo(DocType::class, 'doc_type_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
