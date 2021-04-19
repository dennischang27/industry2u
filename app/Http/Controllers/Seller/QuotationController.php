<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\QuotationRequests;
use App\Models\QuotationRequestDetails;
use App\Models\CompanyUser; 
use App\Models\Company;
use App\Models\ProductDiscount;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Term;
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
        $companyId = 0;
        $user_id = $user->id;

        if(isset($user->companyMember->company_id)){
            $companyId = $user->companyMember->company_id;
        }else{
            // Handle existing users, Add admin user to company_user table
            $company = Company::where('user_id', $user->id)->first();

            $company_user = new CompanyUser;
            $company_user->user_id = $user->id;
            $company_user->company_id = $company->id;
            $company_user->save();

            $companyId = $company->id;
        }

        $quotation_requests = QuotationRequests::where('supplier_company_id', $companyId)
                                ->where('supplier_user_id', $user->id)
                                ->where('status', 'Pending Quotation')
                                ->orWhere('status', 'Pending Approval')
                                ->orWhere(function ($query) {
                                    $query->orWhere('status', 'Quotation Rejected')
                                          ->where('remark', '=', 'Discount Rate - 30%');
                                })
                                ->get();

        $terms = Term::where('company_id', $companyId)->get();

        return view('seller.quote',compact('quotation_requests','i','user_id','terms'));
    }

    public function quoteissued()
    {
        $user = parent::getUser();
        $i = 0;

        // Check Quotation Request Validity
        $affected = DB::table('quotation_requests')
              ->where('purchaser_company_id', $user->companyMember->company_id) 
              ->where('status', 'Pending Confirmation')
              ->where('quotation_valid_until', '<', DB::raw('curdate()'))
              ->update(['status' => 'Quotation Expired']);

        $quotation_requests = QuotationRequests::where('supplier_company_id', $user->companyMember->company_id)
                                ->where('status', 'Pending Confirmation')
                                ->orWhere('status', 'Quotation Verified')
                                ->orWhere('status', 'Confirmed')
                                ->orWhere('status', 'Quotation Expired')
                                ->orWhere(function ($query) {
                                    $query->orWhere('status', 'Quotation Rejected')
                                          ->where('remark', '=', 'Out of Stock');
                                })
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

    public function quoteterm(Request $request)
    {
        $payment_term = $request->payment_term;
        $term_code = $request->term_code;
        $term_qr_id = $request->term_qr_id;

        $qr = QuotationRequests::where('id', $term_qr_id)->first();
        $qr->payment_term_code = $term_code;
        $qr->payment_term_days = $payment_term;
        $qr->save();

        return redirect()->route('seller.quote')->with('message','Payment Term updated successfully.');
    }
    
    public function adddiscount(Request $request)
    {   
        $qr_detail_id = $request->qr_detail_id;

        $discountT1 = 1-($request->t1/100);
        $discountT2 = 1-($request->t2/100);
        $discountT3 = 1-($request->t3/100);
        $totalDiscount = 100 - (((100*$discountT1)*$discountT2)*$discountT3);

        $total_price = $request->price * $request->quantity;
        $total_discount_amount = $total_price * ($totalDiscount/100);
        $totalAmount = $total_price - $total_discount_amount;

        $qr_detail = QuotationRequestDetails::where('id', '=', $qr_detail_id)->first();
        $qr_detail->discount_tier1 = $request->t1;
        $qr_detail->discount_tier2 = $request->t2;
        $qr_detail->discount_tier3 = $request->t3; 
        $qr_detail->total_discount = $totalDiscount;
        $qr_detail->total_amount = $totalAmount;
        $qr_detail->save();

        return redirect()->route('seller.quote')->with('success','Discount added successfully');
    }

    public function quotationissue(Request $request)
    {
        $user = parent::getUser();
        $company_user = CompanyUser::where('user_id', $user->id)->first();
        $month = date('m');
        $year = date('y');

        // Validate discount limit
        $qr_details = QuotationRequestDetails::where('qr_id', $request->qr_id)->get();
        $is_discount_exceeded = false;

        foreach($qr_details as $qr_detail){
            $product_discount = ProductDiscount::where('product_id', $qr_detail->product_id)
                                    ->where('user_id', $user->id)
                                    ->first();

            if($qr_detail->total_discount){
                if($qr_detail->total_discount > $product_discount->total_discount){
                    $is_discount_exceeded = true;
                }
            }
        }

        if($is_discount_exceeded){
            // Exceed discount limit
            $reporting_user = User::select('users.first_name', 'users.last_name', 'reporting_user.email', 'reporting_user.id')
                            ->leftJoin('users as reporting_user', 'reporting_user.id', '=', 'users.user_reporting_id')
                            ->where('users.id', '=', $user->id)
                            ->first();

            // Update Quotation Status
            $qr = QuotationRequests::where('id', '=', $request->qr_id)->first();
            $qr->status = 'Pending Approval';
            $qr->approve_by = $reporting_user->id;
            $qr->save();

            // Send email notification to reporting line
            $mail["email"] = $reporting_user->email;
            $mail["subject"] = "Quotation Approval Request";
            $mail["firstname"] = $reporting_user->first_name;
            $mail["lastname"] = $reporting_user->last_name;
            Mail::send('seller.quotationapprovalmail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            return redirect()->route('seller.quote')->with('message','Discount limit exceeded');
        }else{
            // Within discount limit
            $qr = QuotationRequests::where('supplier_company_id', $company_user->company->id)
                ->where('quotation_no', '<>', '')
                ->orWhereNotNull('quotation_no')->get();

            $qr_count = $qr->count() + 1;
            $number = str_pad($qr_count, 4, '0', STR_PAD_LEFT);
            $quotation_amount = QuotationRequestDetails::where('qr_id', $request->qr_id)->get()->sum("total_amount");
            $quotation_valid_until = Date('y-m-d', strtotime('+7 days'));

            // Generate Quotation
            $qr = QuotationRequests::where('id', '=', $request->qr_id)->first();
            //$qr->supplier_user_id = $user->id;
            $qr->quotation_no = "SQ".$company_user->company->initial."-".$month.$year."-".$number;
            $qr->quotation_amount = $quotation_amount;
            $qr->quotation_valid_until = $quotation_valid_until;
            $qr->status = 'Pending Confirmation';
            $qr->save();

            // Send email notification to requester
            $user = User::where('id', '=', $qr->requester_id)->first();
            $mail["email"] = $user->email;
            $mail["subject"] = "Quotation";
            $mail["supplier_company_name"] = $qr->supplier_company_name;
            Mail::send('seller.quotationmail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            return redirect()->route('seller.quote')->with('success','Quotation issued successfully');
        }
    }

    public function quotereject(Request $request){
        $user = parent::getUser();
        $qr_id = $request->qr_approve_id;
        $reject_reason = $request->reject_reason;
        $discount_rate = $request->discount_rate;

        // Update Quotation Status
        $qr = QuotationRequests::where('id', '=', $qr_id)->first();
        $qr->status = 'Quotation Rejected';
        if($discount_rate){
            $qr->remark = $reject_reason.' - '.$discount_rate;
        }else{
            $qr->remark = $reject_reason;
        }
        $qr->save();

        // Send email notification
        $quotation_requests = QuotationRequests::select('supplier.email as supplier_email','purchaser.email as purchaser_email','quotation_requests.supplier_company_name')
                                ->where('quotation_requests.id', $qr_id)
                                ->leftJoin('users as supplier', 'supplier.id', '=', 'quotation_requests.supplier_user_id')
                                ->leftJoin('users as purchaser', 'purchaser.id', '=', 'quotation_requests.purchaser_id')
                                ->first();

        if($reject_reason == "Out of Stock"){
            // Send email to Sales Executive 
            $mail["redirection"] = route('seller.quote.issued');
            $mail["email"] = $quotation_requests->supplier_email;
            $mail["subject"] = "Quotation has been rejected";
            $mail["reason"] = $reject_reason;
            $mail["supplier_company_name"] = $quotation_requests->supplier_company_name;
            Mail::send('seller.outofstockmail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            // Send email to Purchaser
            $mail["redirection"] = route('buyer.quote.issued');
            $mail["email"] = $quotation_requests->purchaser_email;
            $mail["subject"] = "Quotation has been rejected";
            $mail["reason"] = $reject_reason;
            $mail["supplier_company_name"] = $quotation_requests->supplier_company_name;
            Mail::send('seller.outofstockmail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            return redirect()->route('seller.quote.issued')->with('message','Quotation has rejected');
        }else{
            // Discount rate: Send email to Sales Executive
            $mail["firstname"] = $user->first_name;
            $mail["lastname"] = $user->last_name;
            $mail["email"] = $quotation_requests->supplier_email;
            $mail["subject"] = "Quotation has been rejected";
            $mail["reason"] = $reject_reason;
            Mail::send('seller.discountratemail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            return redirect()->route('seller.quote')->with('message','Quotation has rejected');
        }
    }

    public function pdfview(Request $request)
    {
        $items = DB::table("items")->get();
        view()->share('items',$items);
        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }
        return view('pdfview');
    }
}
