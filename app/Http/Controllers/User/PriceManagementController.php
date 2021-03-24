<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountTiers;
use App\Models\Discount;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;
use Spatie\Permission\Models\Role;

class PriceManagementController extends Controller
{
    public function index(){

        // get lists of sales moderator, manager and executive that belongto the company
        $user = Auth::getUser();
        $designation = Auth::getUser()->designation_id;
        $companyId = $user->company->id; 

        $userlists = DB::table('company_users')
        ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_tiers.discount_tier1', 'discount_tiers.discount_tier2', 'discount_tiers.discount_tier3', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
        ->leftJoin('discount_tiers', 'users.id', '=', 'discount_tiers.user_id')
        ->where('users.designation_id', '=', '3')->orWhere('users.designation_id', '=', 5)->orWhere('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();
            //  1 - admin //  2 - Moderator //  3 - Sales Moderator //  5 - Sales Manager //  7 - Sales Exec

        $i = 0;

        // if role == admin/moderator
        if ($designation == 1 || $designation == 2) {            

            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_tiers.discount_tier1', 'discount_tiers.discount_tier2', 'discount_tiers.discount_tier3', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_tiers', 'users.id', '=', 'discount_tiers.user_id')
            ->where('users.designation_id', '=', '3')->orWhere('users.designation_id', '=', 5)->orWhere('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        }
        // if role == sales moderator
        elseif ($designation == 3) {

            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_tiers.discount_tier1', 'discount_tiers.discount_tier2', 'discount_tiers.discount_tier3', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_tiers', 'users.id', '=', 'discount_tiers.user_id')
            ->where('users.designation_id', '=', 5)->orWhere('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        } 
        // if role == sales manager
        elseif ($designation == 5) {
            
            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_tiers.discount_tier1', 'discount_tiers.discount_tier2', 'discount_tiers.discount_tier3', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_tiers', 'users.id', '=', 'discount_tiers.user_id')
            ->where('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();

        } 

        return view('user.sales.sales.pricemanagement', compact('userlists', 'i'));
    }

    public function store(Request $request){

        $user = DiscountTiers::where('user_id', request('user_id'))->first();

        $companyuser = Auth::getUser();

        $companyId = $companyuser->company->id; 

        if ($user !== null) {
            $user->update([
                'discount_tier1' => request('discount_tier1'),
                'discount_tier2' => request('discount_tier2'),
                'discount_tier3' => request('discount_tier3'),
                'user_id' => request('user_id'),
                'company_id' => request('company_id'),
                ]);
        } else {
            $user = DiscountTiers::create([
                'discount_tier1' => request('discount_tier1'),
                'discount_tier2' => request('discount_tier2'),
                'discount_tier3' => request('discount_tier3'),
                'user_id' => request('user_id'),
                'company_id' => request('company_id'),
            ]);
        }

        return redirect()->back();



        /*
        $user = Auth::getUser()->id;
        $reportingId = Auth::getUser()->user_reporting_id;

        $masterDiscount = Discount::where('user_id', $user)->first();
        $masterDiscount_tier1 = $masterDiscount->master_tier1;
        $masterDiscount_tier2 = $masterDiscount->master_tier2;
        $masterDiscount_tier3 = $masterDiscount->master_tier3;

        $newDiscountTier = DiscountTiers::where('user_id', $user)->first();
        $newDiscountTier1 = $newDiscountTier['discount_tier1'];
        $newDiscountTier2 = $newDiscountTier['discount_tier2'];
        $newDiscountTier3 = $newDiscountTier['discount_tier3'];

        $isUserExist = DiscountTiers::where('user_id', '=', Auth::user()->id)->count();

        // validation
        // if ($reportingId != null) {
        //     $validator = Validator::make($request->all(), [
        //         'discount_tier1' => 'required|numeric|max:'.$newDiscountTier1, 
        //         'discount_tier2' => 'required|numeric|max:'.$newDiscountTier2, 
        //         'discount_tier3' => 'required|numeric|max:'.$newDiscountTier3
        //     ]);

        // } else {
        //     $validator = Validator::make($request->all(), [
        //         'discount_tier1' => 'required|numeric|max:'.$masterDiscount_tier1, 
        //         'discount_tier2' => 'required|numeric|max:'.$masterDiscount_tier2, 
        //         'discount_tier3' => 'required|numeric|max:'.$masterDiscount_tier3
        //     ]);
        // }
        

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

*/
    }
}
