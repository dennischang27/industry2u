<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;

class DiscountController extends Controller{
    //
    public function index(){

        $user = Auth::getUser()->id;
        $discount = Discount::where('user_id', $user)->first();
        return view('user.discount.index', compact('discount'));
    } 

    public function master(){
        $user = Auth::getUser()->id;
        $discount = Discount::where('user_id', $user)->first();

        return view('user.discount.master', compact('discount'));
    } 

    public function masterCreate(){

        // $discount = new Discount();

        $isUserExist = Discount::where('user_id', '=', Auth::user()->id)->count();
        $user = Auth::getUser()->id;
        $discount = Discount::where('user_id', $user)->first();


        if($isUserExist == 0 ) {
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

        return view('user.discount.index', compact('user', 'discount'));

    }


}
