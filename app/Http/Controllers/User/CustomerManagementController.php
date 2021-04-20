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
use App\Models\DocType;
use App\Models\Company;
use App\Models\Term;

use DataTables;
use DB;
use Log;

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

        $count = count($salesExs);

        if ($count == 0){
            $salesExs = DB::table('company_users')
            ->select('users.id AS user_id', 'users.first_name', 'users.last_name')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->where('users.designation_id', '=', 1)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        }

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


        $count = count($salesExs);

        if ($count == 0){
            $salesExs = DB::table('company_users')
            ->select('users.id AS user_id', 'users.first_name', 'users.last_name')
            ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
            ->where('users.designation_id', '=', 1)
            ->where('company_users.company_id', '=', $companyId)
            ->get();
        }

        $newCustomer = DB::table('quotation_requests')
        ->select('quotation_requests.id', 'companies.name AS company_name', 'quotation_requests.created_at AS created_at', 'quotation_requests.qr_no', 'quotation_requests.purchaser_id', 'quotation_requests.purchaser_company_id')
        ->leftJoin('companies', 'companies.id', '=', 'quotation_requests.purchaser_company_id')
        ->where('supplier_company_id', '=', $companyId)
        ->where('supplier_user_id', '=', null)->orWhere('supplier_user_id', '=', '')
        ->groupBy('purchaser_id')     
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
            'purchaser_id' =>  request('purchaser_id'),
            'purchaser_company_id' => request('purchaser_company_id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        $customerList = DB::table('company_customers')
        ->select('company_customers.purchaser_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_id')
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
        ->select('company_customers.id', 'company_customers.purchaser_id AS customer_id', 'companies.id AS company_id', 'industries.name AS customer_industry_name', 
        'companies.name AS company_name', 'company_customers.created_at AS customer_created_at', 'company_customers.payment_term_code', 'company_customers.payment_term_days', 
        'company_customers.purchaser_company_id')
        ->leftJoin('companies', 'companies.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('industries', 'industries.id', '=', 'companies.industry_id')
        ->where('company_customers.company_salesperson_id', '=', $user->id)
        ->get();

        $terms = Term::where('company_id', $companyId)->get();

        return view('user.sales.customers.mycustomer', compact('customerList', 'i', 'terms'));
    }


    public function updateTerm(Request $request){

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id; 

        $payment_term = $request->payment_term;
        $term_code = $request->term_code;
        $purchaser_company_id = $request->purchaser_company_id;

        DB::table('company_customers')
        ->where('company_customers.purchaser_company_id', $purchaser_company_id)
        ->update([
            'payment_term_code' => $term_code,
            'payment_term_days' => $payment_term,
            'updated_at' => date("Y-m-d H:i:s")
            ]);

        return redirect()->route('user.customermanagement.mycustomer.index')->with('message','Payment Term updated successfully.');

    }


    public function mycustomerDetails ($customer){

        $user = Auth::getUser();

        $company = Company::where('id', $customer)->first();

        $myDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();
        if($company) {
            foreach($company->companyDocs as $document) {
                $myDocuments[$document->doc_type_id] = $document;
            }
        }

        $customerDetails = DB::table('company_customers')
        ->select('company_customers.company_salesperson_id AS company_salesperson_id', 'company_customers.purchaser_company_id AS purchaser_company_id', 
        'companies.name AS company_name', 'companies.created_at AS customer_created_at', 'companies.street AS street', 
        'companies.city AS city', 'companies.postal_code AS postal_code', 'country_states.name AS state', 'companies.phone AS contact_no')
        ->leftJoin('companies', 'companies.id', '=', 'company_customers.purchaser_company_id')
        ->leftJoin('country_states', 'country_states.id', '=', 'companies.state_id')
        ->where('companies.id', '=', $customer)
        ->first();

        return view('user.sales.customers.customerdetails', compact('customer', 'customerDetails', 'myDocuments', 'document_list'));
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

        
        $customerList = DB::table('company_customers')
        ->select('company_customers.id AS id', 'company_customers.purchaser_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at', 'salesEx.first_name AS salesEx_first_name', 'salesEx.last_name AS salesEx_last_name')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_id')
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
        ->select('company_customers.id AS id', 'company_customers.purchaser_id AS customer_id', 'industries.name AS customer_industry_name', 'companies.name AS company_name', 'users.company_name AS customer_company', 'users.created_at AS customer_created_at', 'salesEx.first_name AS salesEx_first_name', 'salesEx.last_name AS salesEx_last_name')
        ->leftJoin('company_users', 'company_users.user_id', '=', 'company_customers.purchaser_id') 
        ->leftJoin('companies', 'companies.id', '=', 'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_customers.purchaser_id')
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
                    ->select('purchaser_id')
                    ->where('id', $value)
                    ->first();

                    DB::table('quotation_requests')
                    ->where('purchaser_company_id', '=', $company_user->purchaser_id)
                    ->where('supplier_company_id', '=', $companyId)
                    ->update(['supplier_user_id' => request('ex_id')]);
                }
            }
        }

        return redirect()->route('user.customermanagement.mycustomer.customerReassign')->with('success','Customers reassigned successfully');

    }


    // manage product by category
    public function manageByCategory($customer){

        $user = Auth::getUser();
        // $companyId = $user->company->id; 
        $companyId = $user->companyMember->company_id;

        $i = 0;

        $masterDiscountTotal = DiscountSettings::where('company_id', $companyId)->where('is_master', 1)->first();
        $totalDiscount = floatval($masterDiscountTotal->total_discount);

        $categories = DB::table('product_categories')
        ->select('product_categories.parent_id', 'prod_cat.name', 'product_discounts.discount_tier1', 'product_discounts.discount_tier2', 'product_discounts.discount_tier3',  'product_discounts.total_discount', 'products.company_id AS company_id')
        ->leftJoin('product_categories AS prod_cat', 'prod_cat.id', '=', 'product_categories.parent_id')
        ->leftJoin('products', 'products.category_id', '=', 'product_categories.id')
        ->leftJoin('product_discounts', 'product_discounts.category_id', 'product_categories.parent_id' )
        ->where('products.company_id', '=', $companyId)
        ->whereNull('products.deleted_at')
        ->groupBy('product_categories.parent_id')
        ->get();

        return view('user.sales.customers.managebycategory', compact('categories', 'i', 'totalDiscount', 'customer'));
    }


    public function manageByCategoryStore(Request $request){

        $user = Auth::getUser();
        $userId = $user->id;
        $companyId = $user->companyMember->company_id;

        $masterDiscount = DiscountSettings::where('company_id', $companyId)->where('user_id', $userId)->first();
        $masterDiscountTotal = floatval($masterDiscount->total_discount);
        $masterDiscountT1 = floatval($masterDiscount->discount_tier1);
        $masterDiscountT2 = floatval($masterDiscount->discount_tier2);
        $masterDiscountT3 = floatval($masterDiscount->discount_tier3);

        $discountT1 = 1-(request('discount_tier1')/100);
        $discountT2 = 1-(request('discount_tier2')/100);
        $discountT3 = 1-(request('discount_tier3')/100);

        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);

        if($totalDiscount > $masterDiscountTotal){

            return "total discount exceed limit";

        } elseif ((request('discount_tier1') > floor($masterDiscountTotal)) && (request('discount_tier2') >= 0) && (request('discount_tier3') >= 0)) {

            return $errorMsg = 'Modify Discount Tiers, total discount exceed limit';

        } else {

            $category_id = request('parent_id');
            $subcategories = ProductCategory::orderBy('name')->where('parent_id', '=', $category_id)->get();

            foreach ($subcategories as $subcategory){
                $products = Product::where('category_id', '=', $subcategory->id)->where('company_id', '=', $user->companyMember->company_id)->get();
                foreach ($products as $product){
                    $productCount = ProductDiscount::where('product_id', '=', $product->id)
                    ->where('user_id', '=', $userId)
                    ->where('company_id', '=', $companyId)
                    ->where('customer_company_id', '=', request('customer_company_id'))
                    ->count();
                    if($productCount == 0){
                        $productDiscount = new ProductDiscount();
                        $productDiscount->product_id = $product->id;
                        $productDiscount->user_id = $userId;
                        $productDiscount->discount_tier1 = request('discount_tier1');
                        $productDiscount->discount_tier2 = request('discount_tier2');
                        $productDiscount->discount_tier3 = request('discount_tier3');
                        $productDiscount->total_discount = $totalDiscount;
                        $productDiscount->category_id = request('parent_id');
                        $productDiscount->subcategory_id = $subcategory->id;
                        $productDiscount->company_id = $companyId;
                        $productDiscount->customer_company_id = request('customer_company_id');
                        $productDiscount->save();
                    }else{
                        $selectedProduct = ProductDiscount::where('product_id', '=', $product->id)
                        ->where('user_id', '=', $userId)
                        ->where('company_id', '=', $companyId)
                        ->first();
                        $selectedProduct->discount_tier1 = request('discount_tier1');
                        $selectedProduct->discount_tier2 = request('discount_tier2');
                        $selectedProduct->discount_tier3 = request('discount_tier3');
                        $selectedProduct->total_discount = $totalDiscount;
                        $selectedProduct->save();
                    }
                }
            }
            
            return "success";

        }

    } 

    public function mycustomerManage(Request $request){

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id;
        $subcategories =  DB::table('product_categories')
        ->select('product_categories.id AS subcat_id', 'product_categories.name AS subcat_name')
        ->leftJoin('products', 'products.category_id', '=', 'product_categories.id')
        ->where('products.company_id', '=', $companyId)
        ->whereNull('products.deleted_at')
        ->groupBy('product_categories.id')
        ->get();

        $i = 0;

        return view('user.sales.customers.mycustomermanage', compact( 'i', 'subcategories'));
    }

    public function getproducts(Request $request){

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id;

        if ($request->ajax()) {
            $data = DB::table('products')
                ->select('product_categories.id AS subcat_id', 'products.id', 'products.name', 'product_categories.name as category_name','brands.name as brand_name', 'products.price as list_price', 'product_discounts.discount_tier1 as discount_tier1', 'product_discounts.discount_tier2 as discount_tier2', 'product_discounts.discount_tier3 as discount_tier3' )
                ->join('product_categories','products.category_id','=','product_categories.id')
                ->join('brands','products.brand_id','=','brands.id')
                ->leftJoin('product_discounts', 'product_discounts.product_id', '=', 'products.id')
                ->where('products.company_id',$companyId)
                ->whereNull('products.deleted_at');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    // $actionBtn = '<button type="button" name="edit" id="'.$row->id.'" class="update btn btn-primary btn-xs"><i class="ti-pencil"></i></button>';
                    // return $actionBtn;

                    // $actionBtn = '<button type="button" class="btn btn-xs btn-primary" id="getEditProductData" data-id="'.$row->id.'"><i class="ti-pencil"></i></button>';
                    // <a class="btn  btn-xs btn-info" href="'.route('seller.products.show',$row->id).'">Show</a>

                    $actionBtn = '
                                <a class="btn  btn-xs btn-primary" onclick="editProduct('.$row->id.')" href="#">Edit</a>';
                    return $actionBtn;
                })
                ->filter(function ($instance) use ($request) {
                    $instance->where('product_categories.id', $request->get('filter_category'));
                    if (!empty($request->get('search'))) {
                         $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('brands.name', 'LIKE', "%$search%")->orWhere('products.name', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }


    }


    public function manageByProductEdit(Request $request, $product, $customerCompanyId){

        $user = Auth::getUser();
        $userId = $user->id;
        $companyId = $user->companyMember->company_id;

        $productDetails = DB::table('products')
        ->select('product_categories.parent_id','product_categories.id AS subcat_id', 'products.id', 'products.name', 'product_categories.name as category_name','brands.name as brand_name', 'products.price as list_price', 'product_discounts.discount_tier1 as discount_tier1', 'product_discounts.discount_tier2 as discount_tier2', 'product_discounts.discount_tier3 as discount_tier3' )
        ->join('product_categories','products.category_id','=','product_categories.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->leftJoin('product_discounts', 'product_discounts.product_id', '=', 'products.id')
        ->where('products.company_id',$companyId)
        ->where('products.id', $product)
        ->whereNull('products.deleted_at')->first();
        

        $masterDiscount = DiscountSettings::where('company_id', $companyId)->where('user_id', $userId)->first();
        $masterDiscountTotal = floatval($masterDiscount->total_discount);


        $productCount = ProductDiscount::where('product_id', '=', $product)
            ->where('user_id', '=', $userId)
            ->where('company_id', '=', $companyId)
            ->where('customer_company_id', '=', $customerCompanyId)
            ->count();


        return view('user.sales.customers.managebyproduct', compact('product', 'productDetails', 'masterDiscountTotal', 'customerCompanyId', 'productCount'));

    }



    public function manageByProductStore(Request $request, $product){

        $user = Auth::getUser();
        $userId = $user->id;
        $companyId = $user->companyMember->company_id;

        $productDetails = DB::table('products')
        ->select('product_categories.parent_id','product_categories.id AS subcat_id', 'products.id', 'products.name', 'product_categories.name as category_name','brands.name as brand_name', 'products.price as list_price', 'product_discounts.discount_tier1 as discount_tier1', 'product_discounts.discount_tier2 as discount_tier2', 'product_discounts.discount_tier3 as discount_tier3' )
        ->join('product_categories','products.category_id','=','product_categories.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->leftJoin('product_discounts', 'product_discounts.product_id', '=', 'products.id')
        ->where('products.company_id',$companyId)
        ->where('products.id', $product)
        ->whereNull('products.deleted_at')->first();

        $masterDiscount = DiscountSettings::where('company_id', $companyId)->where('user_id', $userId)->first();
        $masterDiscountTotal = floatval($masterDiscount->total_discount);
        $masterDiscountT1 = floatval($masterDiscount->discount_tier1);
        $masterDiscountT2 = floatval($masterDiscount->discount_tier2);
        $masterDiscountT3 = floatval($masterDiscount->discount_tier3);

        $discountT1 = 1-(request('discount_tier1')/100);
        $discountT2 = 1-(request('discount_tier2')/100);
        $discountT3 = 1-(request('discount_tier3')/100);

        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);


        if($totalDiscount > $masterDiscountTotal){

            return redirect()->back()->with('error','total discount exceed limit');


        } elseif ((request('discount_tier1') > floor($masterDiscountTotal)) && (request('discount_tier2') >= 0) && (request('discount_tier3') >= 0)) {

            return redirect()->back()->with('error', 'Modify Discount Tiers, total discount exceed limit');

        } else {

            $productCount = ProductDiscount::where('product_id', '=', request('product_id'))
            ->where('user_id', '=', $userId)
            ->where('company_id', '=', $companyId)
            ->where('customer_company_id', '=', request('customer_company_id'))
            ->count();

            if($productCount == 0){
                $productDiscount = new ProductDiscount();
                $productDiscount->product_id = request('product_id');
                $productDiscount->user_id = $userId;
                $productDiscount->discount_tier1 = request('discount_tier1');
                $productDiscount->discount_tier2 = request('discount_tier2');
                $productDiscount->discount_tier3 = request('discount_tier3');
                $productDiscount->total_discount = $totalDiscount;
                $productDiscount->category_id = request('parent_id');
                $productDiscount->subcategory_id = request('subcat_id');
                $productDiscount->company_id = $companyId;
                $productDiscount->customer_company_id = request('customer_company_id');
                $productDiscount->save();
            }else{
                $selectedProduct = ProductDiscount::where('product_id', '=', request('product_id'))
                ->where('user_id', '=', $userId)
                ->where('company_id', '=', $companyId)
                ->first();
                $selectedProduct->discount_tier1 = request('discount_tier1');
                $selectedProduct->discount_tier2 = request('discount_tier2');
                $selectedProduct->discount_tier3 = request('discount_tier3');
                $selectedProduct->total_discount = $totalDiscount;
                $selectedProduct->save();
            }
            
        
            
            $subcategories =  DB::table('product_categories')
            ->select('product_categories.id AS subcat_id', 'product_categories.name AS subcat_name')
            ->leftJoin('products', 'products.category_id', '=', 'product_categories.id')
            ->where('products.company_id', '=', $companyId)
            ->whereNull('products.deleted_at')
            ->groupBy('product_categories.id')
            ->get();

            $i = 0;
            
            return view('user.sales.customers.mycustomermanage', compact('subcategories', 'i'));


        }

    }




}