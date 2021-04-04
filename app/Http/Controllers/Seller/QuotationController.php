<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\QuotationRequests;
use App\Models\QuotationRequestDetails;
use App\Models\CompanyUser;
use Response;
use DB;
use Mail;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quote()
    {
        $user = parent::getUser();
        $i = 0;

        $quotation_requests = QuotationRequests::where('supplier_company_id', $user->companyMember->company_id)
                                ->where('status', 'Pending Quotation')
                                ->get();

        return view('seller.quote',compact('quotation_requests','i'));
    }

    public function quoteissued()
    {
        $user = parent::getUser();
        $i = 0;

        $quotation_requests = QuotationRequests::where('supplier_company_id', $user->companyMember->company_id)
                                ->where('status', 'Pending Confirmation')
                                ->orWhere('status', 'Quotation Rejected')
                                ->orWhere('status', 'Quotation Verified')
                                ->orWhere('status', 'Confirmed')
                                ->get();

        return view('seller.quoteissued',compact('quotation_requests','i'));
    }

    public function quoteDetails(Request $request)
    {
        $qr = QuotationRequests::where('id', $request->qr_id)->first();
        $qr_details = QuotationRequestDetails::where('qr_id', $request->qr_id)->get();
        $i = 0;
        $cust_company = $qr->customerCompany->name;
        //print_r($qr_details);
        return view('seller.quotedetails',compact('qr_details','cust_company','i'));
    }
    
    public function adddiscount(Request $request)
    {   
        $t1 = $request->t1;
        $t2 = $request->t2;
        $t3 = $request->t3;
        $price = $request->price;
        $qr_detail_id = $request->qr_detail_id;
        $quantity = $request->quantity;

        $t1_price = 0;
        $t2_price = 0;
        $t3_price = 0;
        $total_discount = 0;

        // Calculate Discount Total 
        if($t1){
            $t1_price_remain = $price - $price * ($t1/100);
            $t1_price = $price * ($t1/100);
        }

        if($t2){
            $t2_price_remain = $t1_price_remain - $t1_price_remain * ($t2/100);
            $t2_price = $t1_price_remain * ($t2/100);
        }

        if($t3){
            $t3_price_remain = $t2_price_remain - $t2_price_remain * ($t3/100);
            $t3_price = $t2_price_remain * ($t3/100);
        }

        $total_discount = $t1_price + $t2_price + $t3_price;
        $total_discount = $total_discount * $quantity;

        // Calculate Quotation Amount
        $total_price = $price * $quantity;
        $quotation_amount = $total_price - $total_discount;

        $qr_detail = QuotationRequestDetails::where('id', '=', $qr_detail_id)->first();
        $qr_detail->discount_tier1 = $t1;
        $qr_detail->discount_tier2 = $t2;
        $qr_detail->discount_tier3 = $t3;
        $qr_detail->total_discount = $total_discount;
        $qr_detail->total_amount = $quotation_amount;
        $qr_detail->save();

        return redirect()->route('seller.quote')->with('success','Discount added successfully');
    }

    public function quotationissue(Request $request)
    {
        $user = parent::getUser();
        $company_user = CompanyUser::where('user_id', $user->id)->first();
        $month = date('m');
        $year = date('y');

        $qr = QuotationRequests::where('supplier_company_id', $company_user->company->id)
                ->where('quotation_no', '<>', '')
                ->orWhereNotNull('quotation_no')->get();

        $qr_count = $qr->count() + 1;
        $number = str_pad($qr_count, 4, '0', STR_PAD_LEFT);

        $quotation_amount = QuotationRequestDetails::where('qr_id', $request->qr_id)->get()->sum("total_amount");
        $quotation_valid_until = Date('y-m-d', strtotime('+7 days'));

        $qr = QuotationRequests::where('id', '=', $request->qr_id)->first();
        $qr->supplier_user_id = $user->id;
        $qr->quotation_no = "SQ".$company_user->company->initial."-".$month.$year."-".$number;
        $qr->quotation_amount = $quotation_amount;
        $qr->quotation_valid_until = $quotation_valid_until;
        $qr->status = 'Pending Confirmation';
        $qr->save();

        return redirect()->route('seller.quote')->with('success','Quotation issued successfully');
    }
}
