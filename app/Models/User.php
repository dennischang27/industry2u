<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','first_name','last_name','username', 'email', 'password','email_verified_at','mobile',
        'referral_code','is_active','is_company_admin','manage_company_admin',
        'is_super_user','manage_supers','is_buyer','is_seller','company_name','designation',
        'last_login_at',
        'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function company() {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function companyMember() {
        return $this->hasOne(CompanyUser::class, 'user_id');
    }

    public function designationName() {
        return $this->belongsTo(Roles::class, 'designation_id');
    }

    public function departmentName() {
        return $this->belongsTo(Departments::class, 'department_id');
    }

    public function reportingTo() {
        return $this->belongsTo(User::class, 'user_reporting_id');
    }

}
