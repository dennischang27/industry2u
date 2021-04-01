<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountSettings;

class DiscountSettingsController extends Controller
{
    //
    public function masterIndex(){
        $user = Auth::getUser()->id;
        $discount = DiscountSettings::where('user_id', $user)->first();
        return view('user.discount.index', compact('discount'));
    } 

    public function masterCreate(){
        $user = Auth::getUser()->id;
        $discount = DiscountSettings::where('user_id', $user)->first();

        return view('user.discount.master', compact('discount'));
    } 

    public function masterStore(){

        $isUserExist = DiscountSettings::where('user_id', '=', Auth::user()->id)->count();
        $user = Auth::getUser()->id;
        $companyId = Auth::user()->company->id;
        $discount = DiscountSettings::where('user_id', $user)->first();

        $discountT1 = 1-(request('discount_tier1')/100);
        $discountT2 = 1-(request('discount_tier2')/100);
        $discountT3 = 1-(request('discount_tier3')/100);

        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);

        if($isUserExist == 0 ) {

            $discount = new DiscountSettings();
    
            $discount->discount_tier1 = request('discount_tier1');
            $discount->discount_tier2 = request('discount_tier2');
            $discount->discount_tier3 = request('discount_tier3');
            $discount->user_id = $user;
            $discount->company_id = $companyId;
            $discount->is_master = 1;
            $discount->total_discount = $totalDiscount;
            $discount->save();

        } else {

            $discount = DiscountSettings::where('user_id', $user)->first();

            $discount->discount_tier1 = request('discount_tier1');
            $discount->discount_tier2 = request('discount_tier2');
            $discount->discount_tier3 = request('discount_tier3'); 
            $discount->total_discount = $totalDiscount;
            $discount->save();
        }

        return redirect()->route('user.discount.index', compact('user', 'discount'));
    }




}
