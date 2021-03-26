<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierManagementController extends Controller
{
    //
    public function supplierInvitation(){
        return view('user.purchasing.suppliermanagement.supplierinvitation');
    }

    public function mySupplier(){
        return view('user.purchasing.suppliermanagement.mysupplier');
    }
}
