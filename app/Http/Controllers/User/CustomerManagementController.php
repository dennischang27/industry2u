<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\CustomerManagement;
use App\Models\Discount;
use App\Models\User;
use App\Models\QuotationRequests;
use App\Models\CompanyCustomers;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductDiscount;
use App\Models\DiscountSettings;
use DataTables;
use DB;

class CustomerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    // invite customer
    public function inviteCustomerIndex(){
        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $salesExs = DB::table('company_users')
        ->select('users.id', 'users.first_name', 'users.last_name', 'users.designation_id',  'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->where('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();

        return view('user.sales.customers.invitecustomer', compact('salesExs'));
    }

    public function sendInvitation(){
        return view('user.sales.customers.invitecustomer');
    }

    // customer invited 
    public function customerInvitedIndex(){

        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $i = 0;
        
        $customerList = DB::table('company_customers')
        ->select('companies.id','companies.name AS company_name', 'users.mobile AS contact_no', 'companies.created_at', 
        'company_customers.customer_id AS customer_id', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at',
        'industries.name AS company_industry_name', 'industries.name AS customer_industry_name')
        ->leftJoin('companies', 'companies.id', '=', 'company_customers.company_id')
        ->leftJoin('country_states', 'country_states.id', '=', 'companies.state_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.customer_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_id', '=', $companyId)
        ->get();

        return view('user.sales.customers.customernvited', compact('i', 'customerList'));
    }

    // new customer
    public function newcustomerindex(){
        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $i = 0;

        $salesExs = DB::table('company_users')
        ->select('users.id AS user_id', 'users.first_name', 'users.last_name')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->where('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();

        $newCustomer = DB::table('quotation_requests')
        ->select('quotation_requests.id', 'users.company_name AS company_name', 'quotation_requests.created_at AS created_at', 'quotation_requests.qr_no', 'quotation_requests.purchaser_id')
        ->leftJoin('users', 'users.id', '=', 'quotation_requests.purchaser_id')
        ->where('supplier_company_id', '=', $companyId)
        ->where('supplier_user_id', '=', null)->orWhere('supplier_user_id', '=', '')
        ->groupBy('purchaser_company_id')     
        ->get();
        
        return view('user.sales.customers.newcustomer', compact('salesExs', 'newCustomer', 'i'));
    }

    public function newcustomerassign(Request $request){

        $i = 0;

        $user = Auth::getUser();
        $companyId = $user->company->id; 

        // update company customer table
        DB::table('company_customers')->insert([
            'company_id' => $companyId,
            'company_salesperson_id' => request('sales_ex_id'),
            'purchaser_company_id' =>  request('purchaser_id')
        ]);

        $customerList = DB::table('company_customers')
        ->select('company_customers.purchaser_company_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_company_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_customers.company_id', '=', $companyId)
        ->get();

        
        // update QR table 
        $QR = QuotationRequests::where('id', request('id'))->first();
        $QR->supplier_user_id = request('sales_ex_id');
        $QR->save();


        return view('user.sales.customers.mycustomer', compact('customerList', 'i'));
    }


    // my customer
    public function mycustomerindex(){

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id; 

        $i = 0;
        
        $customerList = DB::table('company_customers')
        ->select('company_customers.purchaser_company_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_company_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_customers.company_id', '=', $companyId)
        ->get();


        return view('user.sales.customers.mycustomer', compact('customerList', 'i'));
    }


    public function mycustomerDetails ($customer){


        $customerDetails = DB::table('company_users')
        ->select( 'users.id AS id', 'companies.name AS company_name', 'companies.phone AS contact_no', 'companies.created_at AS customer_created_at', 'companies.postal_code', 'companies.street', 'country_states.name AS state', 'companies.city')
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('country_states', 'country_states.id', '=', 'companies.state_id')
        ->where('users.id', '=', $customer)
        ->first();

        return view('user.sales.customers.customerdetails', compact('customer', 'customerDetails'));
    }



    // reassign customer
    public function customerReassign(){
        $i = 0;
        
        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $salesExs = DB::table('company_users')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->where('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();

        $user = Auth::getUser();
        $companyId = $user->company->id; 
        
        $customerList = DB::table('company_customers')
        ->select('company_customers.id AS id', 'company_customers.purchaser_company_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at', 'salesEx.first_name AS salesEx_first_name', 'salesEx.last_name AS salesEx_last_name')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_company_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('users AS salesEx', 'salesEx.id', '=', 'company_customers.company_salesperson_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_customers.company_id', '=', $companyId)
        ->get();

        return view('user.sales.customers.reassigncutomer', compact('i', 'salesExs', 'customerList'));
    }


    public function customerReassignStore(Request $request){

        $i = 0;
        
        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $salesExs = DB::table('company_users')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->where('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();

        $user = Auth::getUser();
        $companyId = $user->company->id; 
        
        $customerList = DB::table('company_customers')
        ->select('company_customers.id AS id', 'company_customers.purchaser_company_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at', 'salesEx.first_name AS salesEx_first_name', 'salesEx.last_name AS salesEx_last_name')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_company_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('users AS salesEx', 'salesEx.id', '=', 'company_customers.company_salesperson_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_customers.company_id', '=', $companyId)
        ->get();


        if(!null == $request->input('customer_id')){
            if(!empty($request->input('customer_id'))) {
                foreach($request->input('customer_id') as $value){
                    DB::table('company_customers')
                    ->where('id', $value)
                    ->update(['company_salesperson_id' => request('ex_id')]);

                    $company_user = DB::table('company_customers')
                    ->select('purchaser_company_id')
                    ->where('id', $value)
                    ->first();

                    DB::table('quotation_requests')
                    ->where('purchaser_company_id', '=', $company_user->purchaser_company_id)
                    ->where('supplier_company_id', '=', $companyId)
                    ->update(['supplier_user_id' => request('ex_id')]);
                }
            }
        }

        return redirect()->route('user.customermanagement.mycustomer.customerReassign')->with('success','Customers reassigned successfully');

    }
}