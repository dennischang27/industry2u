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
        $input = $request;
        if ($query) {
            $input['q'] = $query;
        }
        $products = Product::latest()->paginate(12);
        return view('front.products', compact('products'));
//        $products = Self::getProduct($input);
//        return view('front.products', compact('products', 'query'));
    }

    public function product_detail(Product $product)
    {
        return view('front.product_detail', compact('product'));

    }
    private function getProduct($request){

        $name = $request->input('q', null);
        $query = Request::query();
        $ags = Request::input('ag', []);
        $as = Request::input('a', []);
        $mcs = Request::input('mc', []);
        $pts = Request::input('pt', []);
        $mArr = Request::input('m', []);
        $m = [];
        $queryVar = [
            'name'        => $request->input('q', null),
            'sort_by'     => $request->input('sort-by'),
            'num'         => $request->input('num') ? (int)$request->input('num') : (int)9,
        ];
        switch ($queryVar['sort_by']) {
            case 'date_asc':
                $orderBy = [
                    'products.created_at' => 'asc',
                ];
                break;
            case 'date_desc':
                $orderBy = [
                    'products.created_at' => 'desc',
                ];
                break;
            case 'name_asc':
                $orderBy = [
                    'products.name' => 'asc',
                ];
                break;
            case 'name_desc':
                $orderBy = [
                    'products.name' => 'desc',
                ];
                break;
            default:
                $orderBy = [
                    'products.created_at' => 'DESC',
                ];
                break;
        }


        $products = Product::where(
            [
                'name'                => $queryVar['name'],

            ]

        )->orderby( $orderBy
        )->paginate(['per_page'      => $queryVar['num'],
                    'current_paged' => (int)$request->query('page', 1),
                ]
        );
        return $products;
    }
}
