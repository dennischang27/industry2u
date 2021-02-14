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
        $categoryid = $request->get('categoryid');

        $rawCategories =[];
        $rawCategories = $request->input('categories', null);

        if($rawCategories) {
            $Subcategory = ProductCategory::whereIn('parent_id', $rawCategories)->pluck('id')->toArray();

        }else{
            $Subcategory=[];
            $subcategory = [];
        }
        if($num){
            $pageqty =$num;
        }else{
            $pageqty =16;
        }
        $categories = ProductCategory::with([ 'subProducts'])->where('parent_id', null)->get();
        $attributes = Attribute::with(['attributemeasurement'])->where('is_filterable', 1)->orderBy('name')->get(['id', 'name', 'is_range']);

        if ($categoryid){
            $products = Product::where('name', 'like', '%'.$query.'%')->where('category_id', $categoryid)->paginate($pageqty);
            $subcategory = ProductCategory::findorfail($categoryid);
        }else{
            $products = Product::where('name', 'like', '%'.$query.'%')->paginate($pageqty);
            $subcategory = [];

        }
        return view('front.products', compact('products', 'categories','subcategory'));
    }

    public function product_detail(Product $product)
    {
        return view('front.product_detail', compact('product'));

    }
}
