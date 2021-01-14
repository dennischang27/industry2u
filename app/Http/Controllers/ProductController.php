<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

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
        if ($query) {
            $products = $productService->getProduct($request);

            SeoHelper::setTitle(__('Search result "' . $query . '" '))
                ->setDescription(__('Products: ') . '"' . $request->get('q') . '"');
            Theme::breadcrumb()->add(__('Home'), url('/'))->add(__('Search'), route('public.products'));

            return Theme::scope('ecommerce.search', compact('products', 'query'),
                'plugins/ecommerce::themes.search')->render();
        }
        $products = Product::latest()->paginate(12);
        return view('front.products', compact('products'));
    }

    public function product_detail(Product $product)
    {
        return view('front.product_detail', compact('product'));

    }
}
