<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
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

//        $sortBy = $request->get('sort-by');
//        switch ($sortBy) {
//            case 'date_asc':
//                $orderBy = [
//                    'products.created_at' => 'asc',
//                ];
//                break;
//            case 'date_desc':
//                $orderBy = [
//                    'products.created_at' => 'desc',
//                ];
//                break;
//            case 'name_asc':
//                $orderBy = [
//                    'products.name' => 'asc',
//                ];
//                break;
//            case 'name_desc':
//                $orderBy = [
//                    'products.name' => 'desc',
//                ];
//                break;
//            default:
//                $orderBy = [
//                    'products.created_at' => 'DESC',
//                ];
//                break;
//        }
//
        if($num){
            $pageqty =$num;
        }else{
            $pageqty =9;
        }

        $products = Product::where('name', 'like', '%'.$query.'%')->paginate($pageqty);
        return view('front.products', compact('products'));
    }

    public function product_detail(Product $product)
    {
        return view('front.product_detail', compact('product'));

    }
}
