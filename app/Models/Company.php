<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'street', 'postal_code', 'city', 'state_id', 'country_id', 'industry_id',
        'company_budget_range_id', 'phone', 'reg_no','web_site','sst_no','logo', 'bank_id','bank_account',
        'status','is_active', 'user_id', 'is_approved'
    ];

    public function bank() {
        return $this->belongsTo(Bank::class);
    }
    public function industry() {
        return $this->belongsTo(Industry::class);
    }
    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function state() {
        return $this->belongsTo(CountryState::class);
    }
    public function companybudgetrange() {
        return $this->belongsTo(CompanyBudgetRange::class, 'company_budget_range_id');
    }

    public function companyDocs() {
        return $this->hasMany(CompanyDoc::class);
    }
    public function Products() {
        return $this->hasMany(Product::class, 'company_id');
    }
    public function companyMembers() {
        return $this->hasMany(CompanyUser::class);
    }
    public function adminUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
