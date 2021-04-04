<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationRequests extends Model
{
    protected $fillable = [
        'supplier_company_name', 'supplier_company_id', 'supplier_user_id', 'requester_id', 'qr_no', 'qr_valid_until',
        'quotation_no', 'quotation_amount', 'quotation_valid_until', 'purchaser_id', 'purchaser_company_id',
        'status'
    ];

    public function requestBy() {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function customerCompany() {
        return $this->belongsTo(Company::class, 'purchaser_company_id');
    }

    public function supplierCompany() {
        return $this->belongsTo(Company::class, 'supplier_company_id');
    }
}
