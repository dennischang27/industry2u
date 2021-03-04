<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;

// use App\Models\Company;
use DB;

class DiscountController extends Controller
{
    //
    public function index()
    {

        $user = Auth::getUser()->id;
        $discount = Discount::where('user_id', $user)->first();

        return view('seller.discount.index', compact('discount'));
    } 

    public function master(){


        $user = Auth::getUser();
        // $discount = Discount::find($user_id);
        return view('seller.discount.master', 
        // compact('discount')
    );
    } 

    public function manager(){

        $user = Auth::getUser()->id;

        return view('seller.discount.manager', compact('user'));
    } 

    public function masterCreate(){

        $discount = new Discount();
        $isUserExist = Discount::where('user_id', '=', Auth::user()->id)->count();

        if($isUserExist == 0 ) {
            $user = Auth::getUser()->id;
            $discount = new Discount();
    
            $discount->master_tier1 = request('master_tier1');
            $discount->master_tier2 = request('master_tier2');
            $discount->master_tier3 = request('master_tier3');
            $discount->user_id = $user;
    
            $discount->save();

        } else {

            $discount = Discount::where('user_id', $user)->first();

            $discount->master_tier1 = request('master_tier1');
            $discount->master_tier2 = request('master_tier2');
            $discount->master_tier3 = request('master_tier3'); 

            $discount->save();
        }

        return view('seller.discount.master', compact('user'));

    }

    public function managerCreate(){

        $discount = new Discount();
        $isUserExist = Discount::where('user_id', '=', Auth::user()->id)->count();
        if($isUserExist == 0 ) {
            $user = Auth::getUser()->id;
            $discount = new Discount();
    
            $discount->manager_tier1 = request('manager_tier1');
            $discount->manager_tier2 = request('manager_tier2');
            $discount->manager_tier3 = request('manager_tier3');
            $discount->user_id = $user;
    
            $discount->save();

        } else {
            $user = Auth::getUser()->id;
            $discount = Discount::where('user_id', $user)->first();

            $discount->manager_tier1 = request('manager_tier1');
            $discount->manager_tier2 = request('manager_tier2');
            $discount->manager_tier3 = request('manager_tier3'); 

            $discount->save();
        }

        return view('seller.discount.manager', compact('user'));

    }

    public function salesCreate(){

        $discount = new Discount();
        $isUserExist = Discount::where('user_id', '=', Auth::user()->id)->count();

        if($isUserExist == 0 ) {
            $user = Auth::getUser()->id;
            $discount = new Discount();
    
            $discount->sales_tier1 = request('sales_tier1');
            $discount->sales_tier2 = request('sales_tier2');
            $discount->sales_tier3 = request('sales_tier3');
            $discount->user_id = $user;
    
            $discount->save();

        } else {

            $user = Auth::getUser()->id;

            $discount = Discount::where('user_id', $user)->first();

            $discount->sales_tier1 = request('sales_tier1');
            $discount->sales_tier2 = request('sales_tier2');
            $discount->sales_tier3 = request('sales_tier3'); 

            $discount->save();
        }

        return view('seller.discount.sales', compact('user'));

    }

    public function sales(){

        $user = Auth::getUser();
        return view('seller.discount.sales');
    } 
}
