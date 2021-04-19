<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use DB;
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

        $searchtxt = (string)$request->get('q');
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


        $explode_searchtxts = explode(" ", $searchtxt);

        DB::enableQueryLog();

        if ($categoryid){
            if($searchtxt){
            $products = DB::table('products')
                ->join('product_categories', function($builder) {
                    $builder->on('product_categories.id', '=', 'products.category_id');
                })
                ->join('brands', function($builder) {
                    $builder->on('brands.id', '=', 'products.brand_id');
                })
                ->join('companies', function($builder) {
                    $builder->on('companies.id', '=', 'products.company_id');
                })
                ->join('country_states', function($builder) {
                    $builder->on('companies.state_id', '=', 'country_states.id');
                })
                ->join('product_images', function($builder) {
                    $builder->on('product_images.product_id', '=', 'products.id');
                    $builder->where('product_images.name', '=', 'image_thumbnail');
                })
                ->where('category_id', $categoryid)
                ->whereNull('products.deleted_at')
                ->orWhere('products.name', 'like', '%'.$searchtxt.'%')
                ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                ->orWhere('brands.name', 'like', '%'.$searchtxt.'%')
                ->orWhere('companies.name', 'like', '%'.$searchtxt.'%')
                ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                ->inRandomOrder()->paginate($pageqty);
                if (count($products)==16){
                    $recent_products =DB::table('products')
                        ->join('product_categories', function($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');
                        })
                        ->join('country_states', function($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->where('category_id', $categoryid)
                        ->whereNull('products.deleted_at')
                        ->orWhere('products.name', 'like', '%'.$searchtxt.'%')
                        ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                        ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('brands.name', 'like', '%'.$searchtxt.'%')
                        ->orWhere('companies.name', 'like', '%'.$searchtxt.'%')
                        ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                        ->orderBy('products.created_at', 'desc')->paginate(4);
                    $topview_products =DB::table('products')
                        ->join('product_categories', function($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');
                        })
                        ->join('country_states', function($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->where('category_id', $categoryid)
                        ->whereNull('products.deleted_at')
                        ->orWhere('products.name', 'like', '%'.$searchtxt.'%')
                        ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                        ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('brands.name', 'like', '%'.$searchtxt.'%')
                        ->orWhere('companies.name', 'like', '%'.$searchtxt.'%')
                        ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                        ->orderBy('products.views', 'desc')->paginate(4);
                }
                else{
                    $recent_products=[];
                    $topview_products=[];
                }

            }
            else{
                $products = DB::table('products')
                    ->join('product_categories', function($builder) {
                        $builder->on('product_categories.id', '=', 'products.category_id');
                    })
                    ->join('brands', function($builder) {
                        $builder->on('brands.id', '=', 'products.brand_id');
                    })
                    ->join('companies', function($builder) {
                        $builder->on('companies.id', '=', 'products.company_id');
                    })
                    ->join('country_states', function($builder) {
                        $builder->on('companies.state_id', '=', 'country_states.id');
                    })
                    ->join('product_images', function($builder) {
                        $builder->on('product_images.product_id', '=', 'products.id');
                        $builder->where('product_images.name', '=', 'image_thumbnail');
                    })
                    ->where('category_id', $categoryid)
                    ->whereNull('products.deleted_at')
                    ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                    ->inRandomOrder()->paginate($pageqty);
                if (count($products)==16){
                    $recent_products =DB::table('products')
                        ->join('product_categories', function($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');
                        })
                        ->join('country_states', function($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->where('category_id', $categoryid)
                        ->whereNull('products.deleted_at')
                        ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                        ->orderBy('products.created_at', 'desc')->paginate(4);
                    $topview_products =DB::table('products')
                        ->join('product_categories', function($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');
                        })
                        ->join('country_states', function($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->where('category_id', $categoryid)
                        ->whereNull('products.deleted_at')
                        ->select('products.id','products.name', 'products.slug','product_images.path', 'companies.city','country_states.name as state_name' )
                        ->orderBy('products.views', 'desc')->paginate(4);
                }
                else{
                    $recent_products=[];
                    $topview_products=[];
                }
            }
            $subcategory = ProductCategory::findorfail($categoryid);
        }else {
            if ($searchtxt) {
                $products = DB::table('products')
                ->
                join('product_categories', function ($builder) {
                    $builder->on('product_categories.id', '=', 'products.category_id');
                })
                ->join('brands', function ($builder) {
                    $builder->on('brands.id', '=', 'products.brand_id');
                })
                ->join('companies', function ($builder) {
                    $builder->on('companies.id', '=', 'products.company_id');

                })
                ->join('country_states', function ($builder) {
                    $builder->on('companies.state_id', '=', 'country_states.id');
                })
                ->join('product_images', function ($builder) {
                    $builder->on('product_images.product_id', '=', 'products.id');
                    $builder->where('product_images.name', '=', 'image_thumbnail');
                })
                ->whereNull('products.deleted_at')
                ->where('products.name', 'like', '%' . $searchtxt . '%')
                ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                ->orWhere('brands.name', 'like', '%' . $searchtxt . '%')
                ->orWhere('companies.name', 'like', '%' . $searchtxt . '%')
                ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                ->inRandomOrder()->paginate($pageqty);

                if (count($products)==16){
                    $recent_products =DB::table('products')
                        ->
                        join('product_categories', function ($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function ($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function ($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');

                        })
                        ->join('country_states', function ($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function ($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->whereNull('products.deleted_at')
                        ->where('products.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                        ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('brands.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('companies.name', 'like', '%' . $searchtxt . '%')
                        ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                        ->orderBy('products.created_at', 'desc')->paginate(4);
                    $topview_products =DB::table('products')
                        ->
                        join('product_categories', function ($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function ($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function ($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');

                        })
                        ->join('country_states', function ($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function ($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->whereNull('products.deleted_at')
                        ->where('products.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('products.description', 'like', '%'.$searchtxt.'%')
                        ->orWhere('product_categories.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('brands.name', 'like', '%' . $searchtxt . '%')
                        ->orWhere('companies.name', 'like', '%' . $searchtxt . '%')
                        ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                        ->orderBy('products.views', 'desc')->paginate(4);
                }
                else{
                    $recent_products=[];
                    $topview_products=[];
                }
            }
            else{
                $products = DB::table('products')
                    ->
                    join('product_categories', function ($builder) {
                        $builder->on('product_categories.id', '=', 'products.category_id');
                    })
                    ->join('brands', function ($builder) {
                        $builder->on('brands.id', '=', 'products.brand_id');
                    })
                    ->join('companies', function ($builder) {
                        $builder->on('companies.id', '=', 'products.company_id');

                    })
                    ->join('country_states', function ($builder) {
                        $builder->on('companies.state_id', '=', 'country_states.id');
                    })
                    ->join('product_images', function ($builder) {
                        $builder->on('product_images.product_id', '=', 'products.id');
                        $builder->where('product_images.name', '=', 'image_thumbnail');
                    })
                    ->whereNull('products.deleted_at')
                    ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                    ->inRandomOrder()->paginate($pageqty);


                if (count($products)==16){
                    $recent_products =DB::table('products')
                        ->
                        join('product_categories', function ($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function ($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function ($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');

                        })
                        ->join('country_states', function ($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function ($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->whereNull('products.deleted_at')
                        ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                        ->orderBy('products.created_at', 'desc')->paginate(4);
                    $topview_products =DB::table('products')
                        ->
                        join('product_categories', function ($builder) {
                            $builder->on('product_categories.id', '=', 'products.category_id');
                        })
                        ->join('brands', function ($builder) {
                            $builder->on('brands.id', '=', 'products.brand_id');
                        })
                        ->join('companies', function ($builder) {
                            $builder->on('companies.id', '=', 'products.company_id');

                        })
                        ->join('country_states', function ($builder) {
                            $builder->on('companies.state_id', '=', 'country_states.id');
                        })
                        ->join('product_images', function ($builder) {
                            $builder->on('product_images.product_id', '=', 'products.id');
                            $builder->where('product_images.name', '=', 'image_thumbnail');
                        })
                        ->whereNull('products.deleted_at')
                        ->select('products.id', 'products.name', 'products.slug', 'product_images.path', 'companies.city', 'country_states.name as state_name')
                        ->orderBy('products.views', 'desc')->paginate(4);
                 }
                else{
                    $recent_products=[];
                    $topview_products=[];
                }
            }
            $subcategory = [];

        }
        return view('front.products', compact('products', 'categories','subcategory','recent_products','topview_products'));
    }

    public function product_detail(Product $product)
    {
        $Key = 'product' . $product->id;
        if (!\Session::has($Key)) {

            \DB::table('products')
                ->where('id', $product->id)
                ->increment('views', 1);
            \Session::put($Key, 1);
        }
        return view('front.product_detail', compact('product'));

    }
}
