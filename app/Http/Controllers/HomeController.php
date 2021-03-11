<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
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

}
