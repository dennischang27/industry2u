<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Response;
use Illuminate\Http\Request;
use Auth;
use stdClass;
use phpDocumentor\Reflection\Types\Self_;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        $user = Auth::user();
        $cart = session()->get('cart');

        return view('front.cart', compact('cart', 'user'));
    }

    public function update(Request $request, Response $response)
    {
        if ($request->has('checkout')) {
            return redirect()->route('public.cart.checkout');
        }

        $data = $request->input('items', []);
        $cartItem = session()->get('cart');
        foreach ($data as $companyId=>$item) {
            print_r($item);

            foreach($item as $productId => $value)

            if($cartItem){
                if(isset($cartItem[$companyId][$productId])) {
                    if(intval($value['qty']) > 0){
                        $cartItem[$companyId][$productId]['qty']= $value['qty'];
                    }
                }
            }
        }

        if (isset($cartItem)&& !empty($cartItem)){
            session()->put('cart', $cartItem);
        }else{
            session()->forget('cart');
        }
        $response->message = (__('Update cart successfully!'));
        return response()->redirectTo(route('public.cart.view'));
    }

    public function remove($companyId, $productId, Response $response)
    {

        $cart = session()->get('cart');
        $product = Product::find($productId);
        $company = Company::find($companyId);
        if (!$product) {
            $response->message ='This product is out of stock or not exists!';
        }
        if (!$company) {
            $response->message ='This supplier is not a valid company!';
        }

        if($cart) {
            if(isset($cart[$companyId][$productId])) {
                if(count($cart[$companyId])>1){
                    unset($cart[$companyId][$productId]);
                }else{
                    unset($cart[$companyId]);
                }

            }else{
                $response->message ='This product is out of stock or not exists!';
            }
        }
        if (isset($cart)&& !empty($cart)){
            session()->put('cart', $cart);
        }else{
            session()->forget('cart');
        }
        $response->message ='Product '.$product->name.' remove successfully!';
        return response()->json($response);

    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart');

        return view('front.checkout', compact('cart', 'user'));
    }

    public function checkoutProcess()
    {

    }
    public function add(Request $request, Response $response)
    {

        $cart = session()->get('cart');
        $productId = $request->product_id;
        $qty = $request->qty;
        $companyId = $request->company_id;
        $product = Product::find($request->product_id);
        $company = Company::find($request->company_id);

        if(intval($qty) <= 0){
            $response->error ='true';
            $response->message ='The qty must be an integer.';
            return response()->json($response);
        }

        if (!$product) {
            $response->message ='This product is out of stock or not exists!';
        }
        if (!$company) {
            $response->message ='This supplier is not a valid company!';
        }
        if($product->productImage->firstWhere('name', 'image_thumbnail')){
            $productImage = $product->productImage->firstWhere('name', 'image_thumbnail')->path;
        }
        else{
            $productImage = "";
        }
        if($cart) {
            if(isset($cart[$companyId][$productId])) {
                $cart[$companyId][$productId]['qty']= $cart[$companyId][$productId]['qty']+$qty;
            }else{
                $cart[$companyId][$productId] = [
                    "qty" => $qty,
                    "supplier_name" => $company->name,
                    "product_name" => $product->name,
                    "product_slug" => $product->slug,
                    "product_filepath" => $productImage,
                ];
            }
        }else{
            $cart = [];
            $cart[$companyId][$productId] = [
                "qty" => $qty,
                "supplier_name" => $company->name,
                "product_name" => $product->name,
                "product_slug" => $product->slug,
                "product_filepath" => $productImage,
            ];
        }
        session()->put('cart', $cart);
        $response->message ='Added product '.$product->name.' to cart successfully!';
        return response()->json($response);

    }

    public function ajaxcart()
    {
        $c = array();
        $c = session()->get('cart');
        $sum = 0;
        if(!empty($c)){
            $c = array_filter($c);
            foreach ($c as $p) {
                foreach ($p as $item) {
                    $sum += $item['qty'];
                }
            }
        }
        return response()->json([
            'count' => $sum,
        ]);
    }
}
