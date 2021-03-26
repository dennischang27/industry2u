<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitedCustomer extends Model
{
    //
    protected $fillable = [
        'company_id',
        'customer_company_id',
        'customer_fisrt_name',
        'customer_last_name',
        'customer_email',
        'company_salesperson_id',
        'invitaion_code'
    ];  
}
