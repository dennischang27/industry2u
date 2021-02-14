<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use phpDocumentor\Reflection\Types\Self_;

class ProductCategoryController extends Controller
{

    public function __construct()
    {
    }

    public function category(Request $request)
    {
        $category = ProductCategory::findorfail($request->categoryid);
        $subcategories = ProductCategory::where('parent_id', $request->categoryid)->get();
        return view('front.category', compact('category', 'subcategories'));
    }

    public function subcategory(Request $request)
    {
        $subcategory = ProductCategory::findorfail($request->categoryid);

        $categories = ProductCategory::with([ 'subProducts'])->where('parent_id', null)->get();
        $query = $request->get('q');
        $num = $request->get('num');
        if($num){
            $pageqty =$num;
        }else{
            $pageqty =16;
        }
        $products = Product::where('name', 'like', '%'.$query.'%')->where('category_id', $request->categoryid)->paginate($pageqty);
        return view('front.subcategory', compact('subcategory', 'products', 'categories'));
    }

    public function subcategory1(Request $request)
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

}
