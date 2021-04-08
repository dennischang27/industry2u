<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanyCustomers extends Model
{
    //
    protected $fillable = [
        'company_id',
        'company_salesperson_id',
        'purchaser_company_id'
    ];
}
