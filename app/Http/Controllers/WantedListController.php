<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\WantedLists;
use App\Models\User;
use App\Models\QuotationRequests;
use App\Models\QuotationRequestDetails;
use App\Models\CompanyUser;
use App\Models\CompanyCustomers;
use Response;
use Illuminate\Http\Request;
use Auth;
use stdClass;
use phpDocumentor\Reflection\Types\Self_;
use DB;
use Mail;

class WantedListController extends Controller
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
        $wanted_lists = WantedLists::where('user_id', '=', $user->id)
        ->where(function($query)
                {
                $query->where('status', '=', '')->orWhereNull('status');
                })
        ->get();
        return view('front.wanted_list', compact('wanted_lists', 'user'));
    }

    public function quotation_request(Request $request, Response $response)
    {
        $user = Auth::user();
        $user_admin_id = $user->user_admin_id;
        $deduct_wanted_list = 0;

        $company_user = CompanyUser::where('user_id', $user->id)->first();
        $qr = QuotationRequests::where('purchaser_company_id', $company_user->company->id)
                ->where('qr_no', '<>', '')
                ->orWhereNotNull('qr_no')->get();

        $qr_count = $qr->count() + 1;
        $month = date('m');
        $year = date('y');
        $qr_valid_until = Date('y-m-d', strtotime('+7 days'));

        /*******************************************************************************************
         *  9-Engineer, 10-Clerical Staff
         *  Need Get Approval from Purchasing Department 
         *******************************************************************************************/

        /* Quotation Request - Insert new request */
        $records = WantedLists::whereIn('id', $request->input('wanted_list_id'))
            ->orderByDesc('supplier_company_id')
            ->get();

        $supplier_company_id = 0;
        $qr_id = 0;

        foreach ($records as $record) {
            if($supplier_company_id == $record->supplier_company_id){
                // Insert quotation request details
                $qr_detail = new QuotationRequestDetails;
                $qr_detail->product_name = $record->product_name;
                $qr_detail->product_id = $record->product_id;
                $qr_detail->brand_id = $record->brand_id;
                $qr_detail->price = $record->product->price;
                $qr_detail->quantity = $record->quantity;
                $qr_detail->uom = 'PCS';
                $qr_detail->total_amount = $record->product->price * $record->quantity;
                $qr_detail->qr_id = $qr_id; 
                $qr_detail->save();
            }else{
                $number = str_pad($qr_count, 4, '0', STR_PAD_LEFT);
                $qr_no = "QR".$company_user->company->initial."-".$month.$year."-".$number;

                // Insert quotation request
                $qr = new QuotationRequests;
                $qr->supplier_company_name = $record->supplier_company_name;
                $qr->supplier_company_id = $record->supplier_company_id;
                $qr->requester_id = $record->user_id;
                $qr->qr_no = $qr_no;
                $qr->qr_valid_until = $qr_valid_until;
                $qr->purchaser_id = $user->id;
                $qr->purchaser_company_id = $record->purchaser_company_id;

                if($user->designation_id == 9 || $user->designation_id == 10){
                    $qr->status = 'Request Quotation';
                }else{
                    $qr->status = 'Pending Quotation';
                }

                // Get default payment term
                
                $company_customer = CompanyCustomers::where('company_id', $record->supplier_company_id)
                        ->where('purchaser_company_id', $record->purchaser_company_id)
                        ->first();

                if($company_customer!=null){
                    $qr->payment_term_code = $company_customer->payment_term_code;
                    $qr->payment_term_days = $company_customer->payment_term_days;
                }

                $qr->save();

                $qr_id = $qr->id;

                if($user->designation_id !== 9 && $user->designation_id !== 10){
                    // An email notification will be sent to Supplier - Sales Executive(7), Sales Manager(5), Sales Moderator(3)
                    $arrsuppliers = [3,5,7];
                    $suppliers = CompanyUser::select('users.first_name as first_name','users.last_name as last_name','users.email as email')
                                ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
                                ->where('company_users.company_id', $record->supplier_company_id)
                                ->whereIn('users.designation_id', $arrsuppliers)
                                ->get();
                    
                    if($suppliers){
                        foreach ($suppliers as $supplier) {
                            //echo $supplier->email."<br/>";
                            $mail["email"] = $supplier->email;
                            $mail["subject"] = "Quotation Request";
                            $mail["purchaser"] = $company_user->company->name;
    
                            Mail::send('buyer.tosuppliermail', $mail, function($message)use($mail) {
                                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                            });
                        }
                    }
                }
                
                // Insert quotation request details
                $qr_detail = new QuotationRequestDetails;
                $qr_detail->product_name = $record->product_name;
                $qr_detail->product_id = $record->product_id;
                $qr_detail->brand_id = $record->brand_id;
                $qr_detail->price = $record->product->price;
                $qr_detail->quantity = $record->quantity;
                $qr_detail->total_amount = $record->product->price * $record->quantity;
                $qr_detail->uom = 'PCS';
                $qr_detail->qr_id = $qr->id; 
                $qr_detail->save();
                $qr_count += 1;
            }
            $supplier_company_id = $record->supplier_company_id;
        }

        /* Wanted List - Update status to Request Quotation */
        if(!null == $request->input('wanted_list_id')){
            if(!empty($request->input('wanted_list_id'))) {
                foreach($request->input('wanted_list_id') as $value){
                    WantedLists::where('id',$value)->update(['status'=>'Request Quotation']);
                    $deduct_wanted_list += 1;
                }
            }
        }

        $total_wanted_list = session()->get('total_wanted_list');
        $total_wanted_list = $total_wanted_list - $deduct_wanted_list;
        session()->put('total_wanted_list', $total_wanted_list);
        
        /* Send email to Purchasing Department
            8-Puchasing Executive, 6-Puchasing Manager, 4-Puchasing Moderator */
        if($user->designation_id == 9 || $user->designation_id == 10){
            $users = User::where('user_admin_id', $user_admin_id)->where('designation_id', 4)->orWhere('designation_id', 6)->orWhere('designation_id', 8)->get();
            foreach ($users as $user) {
                $mail["email"] = $user->email;
                $mail["subject"] = "Quotation Request";
                $mail["firstname"] = $user->first_name;
                $mail["lastname"] = $user->last_name;

                Mail::send('user.requestquotationmail', $mail, function($message)use($mail) {
                    $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                });
            }
        }

        return redirect()->route('public.wantedlist.view')->with('success','Quotation requested successfully');
    }

    public function update($wantedListId, $quantity, Response $response)
    {
        WantedLists::where('id',$wantedListId)->update(['quantity'=>$quantity]);
        return redirect()->route('public.wantedlist.view')->with('success','Product updated successfully');
    }

    public function remove($wantedListId, $product, Response $response)
    {
        WantedLists::where('id', $wantedListId)->delete();
        $total_wanted_list = session()->get('total_wanted_list');
        session()->put('total_wanted_list', $total_wanted_list-1);
        return redirect()->route('public.wantedlist.view')->with('success','Product deleted successfully');
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
        $user = Auth::user();
        $qty = $request->qty;
        $product = Product::find($request->product_id);
        $company = Company::find($request->company_id);

        $wanted_list = WantedLists::where('product_id', '=', $request->product_id)
                        ->where('supplier_company_id', '=', $request->company_id)
                        ->where('user_id', '=', $user->id)
                        ->where(function ($query) {
                            $query->where('status', '=', '')
                                ->orWhereNull('status');
                        })
                        ->first();

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
        } else {
            $productImage = "";
        }

        if ($wanted_list === null) {
            // does not exist
            $new_product = new WantedLists;
            $new_product->product_id = $request->product_id;
            $new_product->product_name = $product->name;
            $new_product->supplier_company_id = $request->company_id;
            $new_product->supplier_company_name = $company->name;
            $new_product->product_slug = $product->slug;
            $new_product->product_filepath = $productImage;
            $new_product->quantity = $qty;
            $new_product->brand_id = $product->brand_id;
            $new_product->purchaser_company_id = $user->companyMember->company_id;
            $new_product->user_id = $user->id;
            $new_product->save();
        } else {
            // exits
            $qty = $qty + $wanted_list->quantity;
            $wanted_list->quantity = $qty;
            $wanted_list->save();
        }

        $total_wanted_list = session()->get('total_wanted_list');
        $total_wanted_list = $total_wanted_list + 1;

        session()->put('total_wanted_list', $total_wanted_list);

        $response->message ='Added product '.$product->name.' to cart successfully!';
        $response->total_wanted_list = $total_wanted_list;
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
