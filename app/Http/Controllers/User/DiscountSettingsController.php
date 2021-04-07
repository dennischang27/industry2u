<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountSettings;
use App\Models\User;
use DB;
use Spatie\Permission\Models\Role;

class DiscountSettingsController extends Controller
{
    //
    public function masterIndex(){
        $user = Auth::getUser()->id;
        $discount = DiscountSettings::where('user_id', $user)->first();
        return view('user.discount.index', compact('discount'));
    } 

    public function masterCreate(){
        $user = Auth::getUser()->id;
        $discount = DiscountSettings::where('user_id', $user)->first();

        return view('user.discount.master', compact('discount'));
    } 

    public function masterStore(){

        $isUserExist = DiscountSettings::where('user_id', '=', Auth::user()->id)->count();
        $user = Auth::getUser()->id;
        $companyId = Auth::user()->company->id;
        $discount = DiscountSettings::where('user_id', $user)->first();

        $discountT1 = 1-(request('discount_tier1')/100);
        $discountT2 = 1-(request('discount_tier2')/100);
        $discountT3 = 1-(request('discount_tier3')/100);

        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);

        if($isUserExist == 0 ) {

            $discount = new DiscountSettings();
    
            $discount->discount_tier1 = request('discount_tier1');
            $discount->discount_tier2 = request('discount_tier2');
            $discount->discount_tier3 = request('discount_tier3');
            $discount->user_id = $user;
            $discount->company_id = $companyId;
            $discount->is_master = 1;
            $discount->total_discount = $totalDiscount;
            $discount->save();

        } else {

            $discount = DiscountSettings::where('user_id', $user)->first();

            $discount->discount_tier1 = request('discount_tier1');
            $discount->discount_tier2 = request('discount_tier2');
            $discount->discount_tier3 = request('discount_tier3'); 
            $discount->total_discount = $totalDiscount;
            $discount->save();
        }

        return redirect()->route('user.discount.index', compact('user', 'discount'));
    }


    public function index(){

        // get lists of sales moderator, manager and executive that belongto the company
        $user = Auth::getUser();
        $designation = Auth::getUser()->designation_id;
        $companyId = $user->company->id; 

        $masterDiscountTotal = DiscountSettings::where('company_id', $companyId)->where('is_master', 1)->first();
        $totalDiscount = floatval($masterDiscountTotal->total_discount);
            //  1 - admin //  2 - Moderator //  3 - Sales Moderator //  5 - Sales Manager //  7 - Sales Exec

        $i = 0;

        // if role == admin/moderator
        if ($designation == 1 || $designation == 2) {    

            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_settings.discount_tier1', 'discount_settings.discount_tier2', 'discount_settings.discount_tier3', 'discount_settings.total_discount', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_settings', 'users.id', '=', 'discount_settings.user_id')
            ->where('users.designation_id', '=', '3')->orWhere('users.designation_id', '=', 5)->orWhere('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        }
        // if role == sales moderator
        elseif ($designation == 3) {

            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_settings.discount_tier1', 'discount_settings.discount_tier2', 'discount_settings.discount_tier3', 'discount_settings.total_discount', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_settings', 'users.id', '=', 'discount_settings.user_id')
            ->where('users.designation_id', '=', 5)->orWhere('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        } 
        // if role == sales manager
        elseif ($designation == 5) {
            
            $userlists = DB::table('company_users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.department_id', 'users.designation_id', 'users.user_admin_id', 'users.department_id', 'users.user_reporting_id', 'departments.name AS dept_name', 'roles.name AS designation_name', 'discount_settings.discount_tier1', 'discount_settings.discount_tier2', 'discount_settings.discount_tier3', 'discount_settings.total_discount', 'a.first_name AS reporting_fname', 'a.last_name AS reporting_lname', 'company_users.company_id')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('users AS a', 'users.user_reporting_id', '=', 'a.id' )
            ->leftJoin('discount_settings', 'users.id', '=', 'discount_settings.user_id')
            ->where('users.designation_id', '=', 7)
            ->where('company_users.company_id', '=', $companyId)
            ->get();

        } 

        return view('user.sales.sales.pricemanagement', compact('userlists', 'i', 'totalDiscount'));
    }

    public function store(Request $request){

        $user = Auth::getUser()->id;
        $reportingId = Auth::getUser()->user_reporting_id;
        $companyId =  Auth::getUser()->company->id; 

        $masterDiscount = DiscountSettings::where('company_id', $companyId)->where('is_master', 1)->first();
        $masterDiscountTotal = floatval($masterDiscount->total_discount);
        $masterDiscountT1 = floatval($masterDiscount->discount_tier1);
        $masterDiscountT2 = floatval($masterDiscount->discount_tier2);
        $masterDiscountT3 = floatval($masterDiscount->discount_tier3);

        $user_id = request('user_id');

        $discountT1 = 1-(request('discount_tier1')/100);
        $discountT2 = 1-(request('discount_tier2')/100);
        $discountT3 = 1-(request('discount_tier3')/100);

        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);

        // validation

        if ($totalDiscount > $masterDiscountTotal) {

            return 'total discount exceed limit';

        } elseif ((request('discount_tier1') > floor($masterDiscountTotal)) && (request('discount_tier2') >= 0) && (request('discount_tier3') >= 0)) {
            return $errorMsg = 'Modify Discount Tiers, total discount exceed limit';

        }
        
        
        else {

            if ($user_id !== null) {

                $discount = DiscountSettings::where('user_id', $user_id)->first();

                $discount->discount_tier1 = request('discount_tier1');
                $discount->discount_tier2 = request('discount_tier2');
                $discount->discount_tier3 = request('discount_tier3');
                $discount->total_discount = floatval($totalDiscount);
                $discount->save();

            } else {
               $user_id = DiscountSettings::create([
                    'discount_tier1' => request('discount_tier1'),
                    'discount_tier2' => request('discount_tier2'),
                    'discount_tier3' => request('discount_tier3'),
                    'user_id' => request('user_id'),
                    'company_id' => request('company_id'),
                    'total_discount' => $totalDiscount
                ]);

            }

            return 'success';
        }

    }

}
