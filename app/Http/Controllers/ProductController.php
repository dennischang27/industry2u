<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use phpDocumentor\Reflection\Types\Self_;

class ProductController extends Controller
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


    public function index(Request $request)
    {
        $query = $request->get('q');
        $num = $request->get('num');

        $rawCategories =[];
        $rawCategories = $request->input('categories', null);

        if($rawCategories) {
            $Subcategory = ProductCategory::whereIn('parent_id', $rawCategories)->pluck('id')->toArray();
        }else{
            $Subcategory=[];
        }
        if($num){
            $pageqty =$num;
        }else{
            $pageqty =16;
        }
        $categories = ProductCategory::with([ 'subProducts'])->where('parent_id', null)->get();
        $attributes = Attribute::with(['attributemeasurement'])->where('is_filterable', 1)->orderBy('name')->get(['id', 'name', 'is_range']);

        if ($Subcategory){
            $products = Product::where('name', 'like', '%'.$query.'%')->whereIn('category_id', $Subcategory)->paginate($pageqty);

        }else{
            $products = Product::where('name', 'like', '%'.$query.'%')->paginate($pageqty);

        }
        return view('front.products', compact('products', 'categories'));
    }

    public function product_detail(Product $product)
    {
        return view('front.product_detail', compact('product'));

    }
}
