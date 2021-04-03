<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\WantedLists;
use App\Mail\InquiryMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use Session;

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

        $user = Auth::user();
        $total_wanted_list = 0;

        if(isset($user->id)){
            $result = WantedLists::where('user_id', '=', $user->id)->where('status', '=', '')->orWhereNull('status')->get();
            $total_wanted_list = $result->count();
        }

        session()->put('total_wanted_list', $total_wanted_list);
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

}
