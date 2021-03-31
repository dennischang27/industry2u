<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Bank;
use App\Models\Company;
use App\Models\CompanyBudgetRange;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\DocType;
use App\Models\Industry;
use App\Models\Currency;
use App\Models\User;

use App\Mail\InquiryMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;

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
        $productcategories = ProductCategory::with([ 'subProducts'])->where('parent_id', null)->get();


        // check whether it's purchaser or user
        $user = Auth::user();
        if($user != null){

            $isPurchaser = Auth::user()->is_buyer; 
            $isSeller = Auth::user()->is_seller; 
            $source = Auth::user()->invite_source;

            if($isPurchaser == 0 && $isSeller == 0 && $source == 'customer'){
                $country = Country::all();
                $state = CountryState::all();
                $currency = Currency::all();
                $industry = Industry::all();
                $companybudgetrange = CompanyBudgetRange::all();
                $bank=Bank::all();
                $doc_types = DocType::where('type','SSM')->get();
                $doc_type_sst = DocType::where('type','SST')->get();
                $id = Auth::user()->id;
                $user = User::where('id', $id)->first();
                $customerId = Auth::getUser()->id;
                
                return view('user.addcompany', compact('source', 'isPurchaser', 'user', 'country', 'state', 'bank','companybudgetrange','doc_types', 'doc_type_sst', 'industry','currency'));
            } else {
                return view('home', compact('brands', 'productcategories'));
            }

        } else {
            return view('home', compact('brands', 'productcategories'));
        }
        

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

}
