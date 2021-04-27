<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Models\QuotationRequests;
use App\Models\QuotationRequestDetails;
use App\Models\CompanyUser;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyCustomers;
use Response;
use DB;
use Mail;
use PDF;

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

        if(isset($user->companyMember->company_id)){
            if($user->designation_id == 9 || $user->designation_id == 10){
                $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                    ->where('status', '<>', 'Pending Confirmation')
                    ->where('requester_id', $user->id)->get();
            }else{
                $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                    ->where('status', '<>', 'Pending Confirmation')
                    ->get();
            }
        }else{
            // Handle existing users
            $company = Company::where('user_id', $user->id)->first();

            $company_user = new CompanyUser;
            $company_user->user_id = $user->id;
            $company_user->company_id = $company->id;
            $company_user->save();

            if($user->designation_id == 9 || $user->designation_id == 10){
                $quotation_requests = QuotationRequests::where('purchaser_company_id', $company->id)
                    ->where('status', '<>', 'Pending Confirmation')
                    ->where('requester_id', $user->id)->get();
            }else{
                $quotation_requests = QuotationRequests::where('purchaser_company_id', $company->id)
                    ->where('status', '<>', 'Pending Confirmation')
                    ->get();
            }
        }

        return view('buyer.quote',compact('quotation_requests'));
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

        $quotation_requests = QuotationRequests::where('purchaser_company_id', $user->companyMember->company_id)
                                ->where('status', 'Pending Confirmation')
                                ->orWhere('status', 'Quotation Verified')
                                ->orWhere('status', 'Confirmed')
                                ->orWhere('status', 'Quotation Expired')
                                ->orWhere(function ($query) {
                                    $query->orWhere('status', 'Quotation Rejected')
                                          ->where('remark', '=', 'Out of Stock');
                                })
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

    public function quotationview(Request $request){
        $qr_id = $request->qr_id;
        $i = 0;
        $supplier_user_name = "";
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

        if($data->supplier_user_id){
            $supplier_user = User::where('id', $data->supplier_user_id)->first();
            $supplier_user_name = $supplier_user->first_name." ".$supplier_user->last_name;
        }

        $products = QuotationRequestDetails::select('quotation_request_details.*','p.series_no AS series_no','c.name AS category_name')
                            ->where('qr_id', $qr_id)
                            ->leftJoin('products AS p', 'p.id', '=', 'quotation_request_details.product_id')
                            ->leftJoin('product_categories AS c', 'c.id', '=', 'p.category_id')
                            ->get();

        $final_amount = 0;
        foreach ($products as $product){
            $final_amount += $product->total_amount;
        }

        if($data->logo){
            $img = 'storage/'.$data->logo;
            if(file_exists($img)){
                $isLogoExist = true;
            }else{
                $isLogoExist = false;
            }
        }else{
            $isLogoExist = false;
        }

        view()->share(['data' => $data, 'products' => $products, 'i' => $i, 'isLogoExist' => $isLogoExist, 'final_amount' => $final_amount, 'supplier_user_name' => $supplier_user_name]);
        if($request->has('qr_id')){
            $pdf = PDF::loadView('quotationview');
            return $pdf->download('quotation.pdf');
        }
        return view('quotationview');
    }

    public function quotationrequestview(Request $request){
        $qr_id = $request->qr_id;
        $i = 0;
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

        $products = QuotationRequestDetails::select('quotation_request_details.*','p.series_no AS series_no','c.name AS category_name')
                            ->where('qr_id', $qr_id)
                            ->leftJoin('products AS p', 'p.id', '=', 'quotation_request_details.product_id')
                            ->leftJoin('product_categories AS c', 'c.id', '=', 'p.category_id')
                            ->get();

        if($data->logo){
            $img = 'storage/'.$data->logo;
            if(file_exists($img)){
                $isLogoExist = true;
            }else{
                $isLogoExist = false;
            }
        }else{
            $isLogoExist = false;
        }

        view()->share(['data' => $data, 'products' => $products, 'i' => $i, 'isLogoExist' => $isLogoExist]);
        if($request->has('qr_id')){
            $pdf = PDF::loadView('quotationrequestview');
            return $pdf->download('quotation_request.pdf');
        }
        return view('quotationrequestview');
    }

    public function quoterequestfileproducts(Request $request){
        $qr_id = $request->qr_id;
        $data = QuotationRequestDetails::select('quotation_request_details.*','p.series_no AS series_no','c.name AS category_name')
                            ->where('qr_id', $qr_id)
                            ->leftJoin('products AS p', 'p.id', '=', 'quotation_request_details.product_id')
                            ->leftJoin('product_categories AS c', 'c.id', '=', 'p.category_id')
                            ->get();

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
        //$data = QuotationRequestDetails::where('qr_id', $qr_id)->get();
        $data = QuotationRequestDetails::select('quotation_request_details.*','p.series_no AS series_no','c.name AS category_name')
                            ->where('qr_id', $qr_id)
                            ->leftJoin('products AS p', 'p.id', '=', 'quotation_request_details.product_id')
                            ->leftJoin('product_categories AS c', 'c.id', '=', 'p.category_id')
                            ->get();

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
        $previous_supplier_id = 0;

        // Update status to Request Quotation
        if(!null == $request->input('quotation_request_id')){
            if(!empty($request->input('quotation_request_id'))) {
                foreach($request->input('quotation_request_id') as $value){
                    // Auto Quotation
                    // Check Is Supplier and Customer Match
                    $status = "";
                    $qr = QuotationRequests::select('supplier_company_id', 'purchaser_company_id')
                        ->where('id', $value)->first();
                    
                    $qr_details = QuotationRequestDetails::where('qr_id', '=', $value)->get();
                    $arr_qr_details=array();

                    foreach($qr_details as $qr_detail){
                        array_push($arr_qr_details, $qr_detail->product_id);
                    }

                    // Check previous quotation
                    $match_qrs = QuotationRequests::where('supplier_company_id', $qr->supplier_company_id)
                        ->where('purchaser_company_id', $qr->purchaser_company_id)
                        ->where('id', '!=' , $value)
                        ->get();

                    foreach($match_qrs as $match_qr){
                        $previous_qr_details = QuotationRequestDetails::where('qr_id', '=', $match_qr->id)->get();
                        $arr_previous_qr_details = array();

                        foreach($previous_qr_details as $previous_qr_detail){
                            array_push($arr_previous_qr_details, $previous_qr_detail->product_id);
                        }
                        
                        if(count($arr_qr_details)==count($arr_previous_qr_details)){
                            $result = array_diff($arr_qr_details, $arr_previous_qr_details);
                            
                            if(empty($result)) {
                                // Quotation Match!
                                // Get previous discount and add to current quotation details
                                foreach($previous_qr_details as $previous_qr_detail){
                                    $selected_qr_details = QuotationRequestDetails::where('qr_id', $value)
                                        ->where('product_id', '=', $previous_qr_detail->product_id)->first();
                                    $selected_qr_details->discount_tier1 = $previous_qr_detail->discount_tier1;
                                    $selected_qr_details->discount_tier2 = $previous_qr_detail->discount_tier2;
                                    $selected_qr_details->discount_tier3 = $previous_qr_detail->discount_tier3;
                                    $selected_qr_details->total_discount = $previous_qr_detail->total_discount;
                                    $selected_qr_details->save();
                                }
                                $previous_supplier_id = $match_qr->supplier_user_id;
                                $status = "match";
                                break;
                            }
                        }
                    }

                    if($status == "match"){
                        //QuotationRequests::where('id',$value)->update(['status'=>'Pending Confirmation','purchaser_id' => $user->id]);
      
                        $company_user = CompanyUser::where('user_id', $user->id)->first();
                        $month = date('m');
                        $year = date('y');

                        $qr = QuotationRequests::where('supplier_company_id', $company_user->company->id)
                                ->where('quotation_no', '<>', '')
                                ->orWhereNotNull('quotation_no')->get();

                        $qr_count = $qr->count() + 1;
                        $number = str_pad($qr_count, 4, '0', STR_PAD_LEFT);

                        $quotation_amount = QuotationRequestDetails::where('qr_id', $value)->get()->sum("total_amount");
                        $quotation_valid_until = Date('y-m-d', strtotime('+7 days'));

                        $qr = QuotationRequests::where('id', '=', $value)->first();
                        $qr->supplier_user_id = $previous_supplier_id;
                        $qr->quotation_no = "SQ".$company_user->company->initial."-".$month.$year."-".$number;
                        $qr->quotation_amount = $quotation_amount;
                        $qr->quotation_valid_until = $quotation_valid_until;
                        $qr->status = 'Quotation Generated';
                        $qr->purchaser_id = $user->id;
                        $qr->save();

                        //Send email notification to requester
                        /*$user = User::where('id', '=', $qr->requester_id)->first();
                        
                        $mail["email"] = $user->email;
                        $mail["subject"] = "Quotation";
                        $mail["supplier_company_name"] = $qr->supplier_company_name;

                        Mail::send('seller.quotationmail', $mail, function($message)use($mail) {
                            $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                        });*/
                    }else{
                        QuotationRequests::where('id',$value)->update(['status'=>'Pending Quotation','purchaser_id' => $user->id]);

                        // An email notification will be sent to Supplier - Sales Executive(7), Sales Manager(5), Sales Moderator(3)
                        /*$arrsuppliers = [3,5,7];
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
                        }*/
                    }
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

                    // An email notification will be sent to Supplier - Admin
                    $company = Company::select('users.email')
                    ->where('companies.id', $data->supplier_company_id)
                    ->leftJoin('users', 'users.id', '=', 'companies.user_id')
                    ->first();

                    $mail["email"] = $company->email;
                    $mail["subject"] = "Quotation Request";
                    $mail["purchaser"] = $data->name;

                    Mail::send('buyer.tosuppliermail', $mail, function($message)use($mail) {
                        $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                    });
                    
                    $company_customer = CompanyCustomers::select('users.user_reporting_id','users.email')
                    ->leftJoin('users', 'users.id', '=', 'company_customers.company_salesperson_id')
                    ->where('company_customers.company_id', $data->supplier_company_id)
                    ->first();

                    if($company_customer){
                        // An email notification will be sent to Supplier - Person In Charge
                        $mail["email"] = $company_customer->email;
                        $mail["subject"] = "Quotation Request";
                        $mail["purchaser"] = $data->name;

                        Mail::send('buyer.tosuppliermail', $mail, function($message)use($mail) {
                            $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                        });

                        // An email notification will be sent to Supplier - Reporting Manager
                        $reporting_user = User::where('id', $company_customer->user_reporting_id)
                                ->first();

                        $mail["email"] = $reporting_user->email;
                        $mail["subject"] = "Quotation Request";
                        $mail["purchaser"] = $data->name;

                        Mail::send('buyer.tosuppliermail', $mail, function($message)use($mail) {
                            $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                        });
                    }else{
                        DB::table('company_customers')->insert([
                            'company_id' => $data->supplier_company_id,
                            'purchaser_id' => $user->id,
                            'purchaser_company_id' => $user->companyMember->company_id,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
        }

        return redirect()->route('buyer.quote')->with('success','Quotation submitted successfully');
    }

    public function rejectquotationrequest(Request $request)
    {
        $qr_ids = json_decode($request->input('qr_id'));
        $selected_qrs = DB::table('quotation_requests')->whereIn('id', $qr_ids)->get();

        foreach ($selected_qrs as $selected_qr) {
            $requester_data = DB::table('users')->where('id', $selected_qr->requester_id)->first();
            // Send email to requester
            $mail["email"] = $requester_data->email;
            $mail["subject"] = "Quotation Request Rejected";
            Mail::send('buyer.quotationrejectedmail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });
        }

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
