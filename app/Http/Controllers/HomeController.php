<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Company;
use App\Models\ProductImage;
use App\Mail\InquiryMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands = Brand::where('is_featured', 1)->limit(6)->get();
        $productcategories = ProductCategory::with([ 'subProducts'])
            ->where('parent_id', null)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
        return view('home', compact('brands', 'productcategories'));
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function privacybm()
    {

        return view('privacybm');
    }

    public function terms()
    {

        return view('terms');
    }
    public function termsbuysell()
    {

        return view('terms_for_buyer_seller');

    }
    public function contactus()
    {
        return view('contact_us');
    }
    public function contactus_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();

        $inquiry = Inquiry::create($input);
        Mail::send(new InquiryMail($input));
        // return redirect()->route('contact_us')
        //     ->with('success','Your message has been sent.');
        return redirect()->back()->with('message', 'Your message has been sent!');

    }
    public function supplierlist(Request $request)
    {
        $query = $request->get('sup');
        $num = $request->get('num');

        if($num){
            $pageqty =$num;
        }else{
            $pageqty =16;
        }

        $companies = Company::where('name','like','%'.$query.'%')
        ->orderBy('name')
        ->paginate($pageqty);

        return view('supplier_list',compact('companies'));

    }
    public function companyprofile($id, Request $request)
    {
        $page = 15;
        $company = Company::find($id);

        $subcatid = $request->get('subcat');
        $categories = DB::table('products')
                        ->join('product_categories as subcategory', 'products.category_id', '=', 'subcategory.id')
                        ->join('product_categories as category', 'subcategory.parent_id', '=', 'category.id')
                        ->where('products.company_id', $company->id )
                        ->whereNull('products.deleted_at')
                        ->select('category.id', 'category.name', 'subcategory.id as subcat_id', 'subcategory.name as subcat_name')
                        ->groupby('category.id', 'category.name', 'subcategory.id', 'subcategory.name')
                        ->get();

        if  ($subcatid){
            if($request->get('sort')=='All' && $subcatid == 'All') {
                $products = Product::where('company_id', $company->id)
                ->orderBy('created_at', 'desc')
                ->paginate($page);

            }elseif ($request->get('sort')=='All' && $subcatid != 'All'){
                $products = Product::where('company_id', $company->id)
                ->where('category_id', $subcatid)
                ->orderBy('name', 'desc')
                ->paginate($page);

            }elseif($request->get('sort')=='product_asc' && $subcatid == 'All'){
                $products = Product::where('company_id', $company->id)
                ->orderBy('name', 'asc')
                ->paginate($page);


            }elseif($request->get('sort')=='product_asc' && $subcatid != 'All'){
                $products = Product::where('company_id', $company->id)
                ->where('category_id', $subcatid)
                ->orderBy('name', 'asc')
                ->paginate($page);

            }elseif($request->get('sort')=='product_desc' && $subcatid == 'All'){
                $products = Product::where('company_id', $company->id)
                ->orderBy('name', 'desc')
                ->paginate($page);

            }elseif($request->get('sort')=='product_desc' && $subcatid != 'All'){
                $products = Product::where('company_id', $company->id)
                ->where('category_id', $subcatid)
                ->orderBy('name', 'desc')
                ->paginate($page);

            }
            else{
            $products = Product::where('company_id', $company->id)
            ->where('category_id', $subcatid)
            ->orderBy('created_at', 'desc')
            ->paginate($page);
            }
            $subcat_selected = ProductCategory::where('id',$subcatid)->first();

        }else{
            $products = Product::where('company_id', $company->id)->orderBy('created_at', 'desc')->paginate($page);
            if ($request->get('sort')=='product_asc'){

                $products = Product::where('company_id', $company->id)
                ->orderBy('name', 'asc')
                ->paginate($page);

            }elseif($request->get('sort')=='product_desc'){
                $products = Product::where('company_id', $company->id)
                ->orderBy('name', 'desc')
                ->paginate($page);

            }
            else{
            $products = Product::where('company_id', $company->id)
            ->orderBy('created_at', 'desc')
            ->paginate($page);
            }
            $subcat_selected ='';
        }

        return view('front.company_profile',compact('products','company','categories','subcatid', 'subcat_selected'));

    }

    public function scopeSearch($q)
    {
    return empty(request()->search) ? $q : $q->where('name', 'like', '%'.request()->search.'%');
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }
    public function faq(Request $request)
    {
        $query = $request->get('q');

        return view('front.faq');
    }
}
