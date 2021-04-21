<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SupplierInvitation;

use DB;

class SupplierManagementController extends Controller
{
    //
    public function supplierInvitation(){

        $user = Auth::getUser();
        $i = 0;

        $supplierList = DB::table('supplier_invitations')
        ->select('companies.id AS company_id', 'companies.name AS supplier_company_name', 'companies.created_at', 'purchaser.id AS purchaser_id', 'supplier.id AS supplier_id')
        ->leftJoin('companies', 'companies.id', '=', 'supplier_invitations.company_id')
        ->leftJoin('users AS supplier', 'supplier.id', '=', 'supplier_invitations.supplier_id')
        ->leftJoin('users AS purchaser', 'purchaser.id', '=', 'supplier_invitations.purchaser_id')
        ->where('supplier_invitations.purchaser_id', '=', $user->id)
        ->where('supplier_invitations.is_joined', '=', 0)
        ->get();

        return view('user.purchasing.suppliermanagement.supplierinvitation', compact('supplierList', 'i'));
    }


    public function supplierJoinInvitation(Request $request){

        $user = Auth::getUser();
        $i = 0;

        $supplier = SupplierInvitation::where('supplier_id', request('supplier_id'))->where('purchaser_id', $user->id)->update(['is_joined' => 1]);

        $supplierList = DB::table('supplier_invitations')
        ->select('companies.id AS company_id', 'companies.name AS supplier_company_name', 'companies.created_at', 'purchaser.id AS purchaser_id', 'supplier.id AS supplier_id')
        ->leftJoin('companies', 'companies.id', '=', 'supplier_invitations.company_id')
        ->leftJoin('users AS supplier', 'supplier.id', '=', 'supplier_invitations.supplier_id')
        ->leftJoin('users AS purchaser', 'purchaser.id', '=', 'supplier_invitations.purchaser_id')
        ->where('supplier_invitations.purchaser_id', '=', $user->id)
        ->where('supplier_invitations.is_joined', '=', 1)
        ->get();

        return redirect()->route('user.suppliermanagement.mysupplier', compact('supplierList', 'i'))->with('success','Joined successfully.');;
    }

    public function mySupplier(){

        $user = Auth::getUser();

        $i = 0;

        $supplierList = DB::table('supplier_invitations')
        ->select('companies.id AS company_id', 'companies.name AS supplier_company_name', 'companies.created_at', 'purchaser.id AS purchaser_id', 'supplier.id AS supplier_id')
        ->leftJoin('companies', 'companies.id', '=', 'supplier_invitations.company_id')
        ->leftJoin('users AS supplier', 'supplier.id', '=', 'supplier_invitations.supplier_id')
        ->leftJoin('users AS purchaser', 'purchaser.id', '=', 'supplier_invitations.purchaser_id')
        ->where('supplier_invitations.purchaser_id', '=', $user->id)
        ->where('supplier_invitations.is_joined', '=', 1)
        ->get();


        return view('user.purchasing.suppliermanagement.mysupplier', compact('supplierList', 'i'));
    }

    public function mySupplierDetails($supplier){

        $supplierDetails = DB::table('supplier_invitations')
        ->select('supplier.id AS supplier_id', 'companies.id AS company_id', 'companies.name AS company_name', 'companies.created_at', 'companies.created_at', 'companies.postal_code', 'companies.street', 'companies.city', 'country_states.name AS state', 'companies.phone')
        ->leftJoin('companies', 'companies.id', '=', 'supplier_invitations.company_id')
        ->leftJoin('users AS supplier', 'supplier.id', '=', 'supplier_invitations.supplier_id')
        ->leftJoin('users AS purchaser', 'purchaser.id', '=', 'supplier_invitations.purchaser_id')
        ->leftJoin('country_states', 'country_states.id', '=', 'companies.state_id')
        ->where('company_id', '=', $supplier)
        ->first();

        return view('user.purchasing.suppliermanagement.supplierdetails', compact('supplierDetails', 'supplier') );
    }
}
