<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Models\QuotationRequests;
use App\Models\QuotationRequestDetails;
use App\Models\CompanyUser;
use App\Models\User;
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

        if($user->designation_id == 9 || $user->designation_id == 10){
            $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                ->where('status', '<>', 'Pending Confirmation')
                ->where('requester_id', $user->id)->get();
        }else{
            $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                ->where('status', '<>', 'Pending Confirmation')
                ->get();
        }

        return view('buyer.quote',compact('quotation_requests'));
    }

    public function quoteissued()
    {
        $user = parent::getUser();
        $i = 0;

        $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                                ->where('status', 'Pending Confirmation')
                                ->orWhere('status', 'Quotation Rejected')
                                ->orWhere('status', 'Quotation Verified')
                                ->orWhere('status', 'Confirmed')
                                ->get();
                                
        return view('buyer.quoteissued',compact('quotation_requests','i'));
    }

    public function quoterequestfile(Request $request){
        $qr_id = $request->qr_id;

        $data = QuotationRequests::select('quotation_requests.*', 'pc.name AS purchaser_company_name', 'scountry.name AS supplier_country', 
                                'pc.reg_no AS purchaser_reg_no', 'sc.street AS supplier_street', 'sc.postal_code AS supplier_postal_code', 
                                'sc.city AS supplier_city', 'sc.phone AS supplier_phone',  'sc.state_id AS supplier_state_id',
                                'pcountry.name AS purchaser_country',  'pc.state_id AS purchaser_state_id', 'sc.name AS supplier_company_name',
                                'pc.street AS purchaser_street', 'pc.postal_code AS purchaser_postal_code', 
                                'pc.city AS purchaser_city', 'pc.phone AS purchaser_phone', 'users.first_name', 'users.last_name',
                                'users.mobile AS user_phone', 'users.email AS user_email', 'pc.logo')
                            ->where('quotation_requests.id', $qr_id)
                            ->leftJoin('companies AS pc', 'pc.id', '=', 'quotation_requests.purchaser_company_id')
                            ->leftJoin('countries AS pcountry', 'pcountry.id', '=', 'pc.country_id')
                            ->leftJoin('companies AS sc', 'sc.id', '=', 'quotation_requests.supplier_company_id')
                            ->leftJoin('countries AS scountry', 'scountry.id', '=', 'sc.country_id')
                            ->leftJoin('users', 'users.id', '=', 'quotation_requests.requester_id')
                            ->first();

        return response()->json($data);
    }

    public function quoterequestfileproducts(Request $request){
        $qr_id = $request->qr_id;
        $data = QuotationRequestDetails::where('qr_id', $qr_id)->get();
        return response()->json($data);
    }

    public function quotefile(Request $request){
        $qr_id = $request->qr_id;

        $data = QuotationRequests::select('quotation_requests.*', 'sc.name AS supplier_company_name', 'scountry.name AS supplier_country', 
                                'sc.reg_no AS supplier_reg_no', 'sc.street AS supplier_street', 'sc.postal_code AS supplier_postal_code', 
                                'sc.city AS supplier_city', 'sc.phone AS supplier_phone',  'sc.state_id AS supplier_state_id',
                                'pcountry.name AS purchaser_country',  'pc.state_id AS purchaser_state_id', 'pc.name AS purchaser_company_name',
                                'pc.street AS purchaser_street', 'pc.postal_code AS purchaser_postal_code', 
                                'pc.city AS purchaser_city', 'pc.phone AS purchaser_phone', 'users.first_name', 'users.last_name',
                                'users.mobile AS user_phone', 'users.email AS user_email', 'sc.logo')
                            ->where('quotation_requests.id', $qr_id)
                            ->leftJoin('companies AS pc', 'pc.id', '=', 'quotation_requests.purchaser_company_id')
                            ->leftJoin('countries AS pcountry', 'pcountry.id', '=', 'pc.country_id')
                            ->leftJoin('companies AS sc', 'sc.id', '=', 'quotation_requests.supplier_company_id')
                            ->leftJoin('countries AS scountry', 'scountry.id', '=', 'sc.country_id')
                            ->leftJoin('users', 'users.id', '=', 'quotation_requests.purchaser_id')
                            ->first();

        return response()->json($data);
    }

    public function quotefileproducts(Request $request){
        $qr_id = $request->qr_id;
        $data = QuotationRequestDetails::where('qr_id', $qr_id)->get();
        return response()->json($data);
    }

    public function quotation(Request $request, Response $response)
    {
        $user = parent::getUser();
        $user_admin_id = $user->user_admin_id;

        if(!null == $request->input('quotation_request_id')){
            if(!empty($request->input('quotation_request_id'))) {
                foreach($request->input('quotation_request_id') as $value){
                    if($user->hasAnyRole(['Engineer', 'Clerical Staff'])){
                        QuotationRequests::where('id',$value)->update(['status'=>'Quotation Verified']);

                        // Send email notification to Purchasing Department
                        $users = User::where('user_admin_id', $user_admin_id)->where('designation_id', 4)->orWhere('designation_id', 6)->orWhere('designation_id', 8)->get();
                        foreach ($users as $user) {
                            $mail["email"] = $user->email;
                            $mail["subject"] = "Quotation Request";
                            $mail["firstname"] = $user->first_name;
                            $mail["lastname"] = $user->last_name;

                            Mail::send('buyer.quotationverifiedmail', $mail, function($message)use($mail) {
                                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                            });
                        }

                    }else{
                        QuotationRequests::where('id',$value)->update(['status'=>'Confirmed']);
                        $qr = QuotationRequests::where('id', $value)->first();

                        // Send email notification to Supplier
                        $arrsuppliers = [3,5,7];
                        $suppliers = CompanyUser::select('users.first_name as first_name','users.last_name as last_name','users.email as email')
                                    ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
                                    ->where('company_users.company_id', $qr->supplier_company_id)
                                    ->whereIn('users.designation_id', $arrsuppliers)
                                    ->get();
                        
                        if($suppliers){
                            foreach ($suppliers as $supplier) {
                                $mail["email"] = $supplier->email;
                                $mail["subject"] = "Quotation Confirmed";
                                $mail["purchaser"] = $qr->customerCompany->name;
        
                                Mail::send('buyer.quotationconfirmedmail', $mail, function($message)use($mail) {
                                    $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                                });
                            }
                        }
                    }
                }
            }
        }
        
        return redirect()->route('buyer.quote.issued')->with('success','Quotation confirmed successfully');
    }

    public function quotationrequest(Request $request, Response $response)
    {
        $user = parent::getUser();

        /* Update status to Request Quotation*/
        if(!null == $request->input('quotation_request_id')){
            if(!empty($request->input('quotation_request_id'))) {
                foreach($request->input('quotation_request_id') as $value){
                    QuotationRequests::where('id',$value)->update(['status'=>'Pending Quotation','purchaser_id' => $user->id]);

                    // An email notification will be sent to Requester
                    $data = QuotationRequests::where('quotation_requests.id', $value)
                            ->leftJoin('companies', 'companies.id', '=', 'quotation_requests.purchaser_company_id')
                            ->first();

                    $mail["email"] = $data->requestBy->email;
                    $mail["subject"] = "Quotation Submitted";
                    $mail["firstname"] = $user->first_name;
                    $mail["lastname"] = $user->last_name;
                    $mail["supplier_company_name"] = $data->supplier_company_name;

                    Mail::send('buyer.torequestermail', $mail, function($message)use($mail) {
                        $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                    });

                    // An email notification will be sent to Supplier - Sales Executive(7), Sales Manager(5), Sales Moderator(3)
                    $arrsuppliers = [3,5,7];
                    $suppliers = CompanyUser::select('users.first_name as first_name','users.last_name as last_name','users.email as email')
                                ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
                                ->where('company_users.company_id', $data->supplier_company_id)
                                ->whereIn('users.designation_id', $arrsuppliers)
                                ->get();
                    
                    if($suppliers){
                        foreach ($suppliers as $supplier) {
                            //echo $supplier->email."<br/>";
                            $mail["email"] = $supplier->email;
                            $mail["subject"] = "Quotation Request";
                            $mail["purchaser"] = $data->name;
    
                            Mail::send('buyer.tosuppliermail', $mail, function($message)use($mail) {
                                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                            });
                        }
                    }
                }
            }
        }

        return redirect()->route('buyer.quote')->with('success','Quotation submitted successfully');
    }

    public function rejectquotationrequest(Request $request)
    {
        $qr_ids = json_decode($request->input('qr_id'));
        $reason = $request->input('reject_reason');
        $other_reason = $request->input('reject_other_reason');

        if($qr_ids){
            if($reason == "Others"){
                DB::table('quotation_requests')->whereIn('id', $qr_ids)->update(array('status' =>'Request Rejected','remark' => $other_reason));
            }else{
                DB::table('quotation_requests')->whereIn('id', $qr_ids)->update(array('status' =>'Request Rejected','remark' => $reason));
            }
        }
        return redirect()->route('buyer.quote')->with('success','Quotation rejected successfully');
    }

    public function rejectquotation(Request $request)
    {
        $qr_ids = json_decode($request->input('qr_id'));
        $reason = $request->input('reject_reason');
        $other_reason = $request->input('reject_other_reason');

        if($qr_ids){
            if($reason == "Others"){
                DB::table('quotation_requests')->whereIn('id', $qr_ids)->update(array('status' =>'Quotation Rejected','remark' => $other_reason));
            }else{
                DB::table('quotation_requests')->whereIn('id', $qr_ids)->update(array('status' =>'Quotation Rejected','remark' => $reason));
            }
        }
        return redirect()->route('buyer.quote.issued')->with('success','Quotation rejected successfully');
    }

    public function cancelquotationrequest(Request $request)
    {
        $qr_ids = json_decode($request->input('cancel_qr_id'));
        if($qr_ids){
            DB::table('quotation_requests')->whereIn('id', $qr_ids)->update(array('status' =>'Request Cancelled'));
        }
        return redirect()->route('buyer.quote')->with('success','Quotation cancelled successfully');
    }
}
