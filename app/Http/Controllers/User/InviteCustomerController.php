<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\CompanyCustomers;
use App\Models\InvitedCustomer;

use DB;
use Mail;


class InviteCustomerController extends Controller
{
    //
    public function inviteCustomerIndex(){
        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $salesExs = DB::table('company_users')
        ->select('users.id', 'users.first_name', 'users.last_name', 'users.designation_id',  'company_users.company_id')
        ->leftJoin('users', 'users.id', '=', 'company_users.user_id')
        ->leftJoin('roles', 'users.designation_id', '=', 'roles.id')
        ->where('users.designation_id', '=', 7)
        ->where('company_users.company_id', '=', $companyId)
        ->get();

        return view('user.sales.customers.invitecustomer', compact('salesExs', 'companyId'));
    }


    function generateRandomString($length = 10) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function sendInvitation(Request $request){

        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $this->validate(request(), [
            'customer_company_name' => 'required',
            'customer_first_name' => 'required',
            'customer_last_name' => 'required',
            'customer_email' => ['required', 'string', 'email', 'max:255'],
            'company_salesperson_id' => 'required',
        ]);

        $invitation_code = $this->generateRandomString(50);

        $customer = InvitedCustomer::where('customer_email', request('customer_email'))->first();
       
        $isUserExist = User::where('email', '=', $request->customer_email)->first();
        
        $new_customer = new InvitedCustomer;
        
        $new_customer->company_id = $request->company_id;
        $new_customer->customer_company_name = $request->customer_company_name;
        $new_customer->customer_first_name = $request->customer_first_name;
        $new_customer->customer_last_name = $request->customer_last_name;
        $new_customer->customer_email = $request->customer_email;
        $new_customer->company_salesperson_id = $request->company_salesperson_id;
        $new_customer->invitation_code = $invitation_code;
        $new_customer->save();

        if($isUserExist === null){
            $new_user = new User;
            $new_user->title = '.';
            $new_user->first_name = $request->customer_first_name;
            $new_user->last_name = $request->customer_last_name;
            $new_user->username = $request->customer_email;
            $new_user->email = $request->customer_email;
            $new_user->company_name = $request->customer_company_name;
            $new_user->password = '.';
            $new_user->is_active = 0;
            $new_user->is_company_admin = 0;
            $new_user->manage_company_admin = 0;
            $new_user->is_super_user = 0;
            $new_user->manage_supers = 0;
            $new_user->is_buyer = 0;
            $new_user->is_seller = 0;
            $new_user->invitation_code = $invitation_code;
            $new_user->invite_source = 'customer';
            $new_user->status = 'pending register';
            $new_user->save();
        } else {
            $isUserExist->invitation_code = $invitation_code;
            $isUserExist->status = 'pending join';
            $isUserExist->is_buyer = 1;
            $isUserExist->is_seller = 0;
            $isUserExist->save();
        }
       
        // send email
        if ($isUserExist === null) {

            $mail["email"] = $request->customer_email;
            $mail["subject"] = "Invitation to register as a customer of " . $user->company->name;
            $mail["company"] = $user->company->name;
            $mail["invitation_code"] = $invitation_code;

            Mail::send('user.sales.customers.mailnewcustomerinvite', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

        } else {

            $mail["email"] = $request->customer_email;
            $mail["subject"] = "Invitation to be a customer of " . $user->company->name;
            $mail["company"] = $user->company->name;
            $mail["invitation_code"] = $invitation_code;

            Mail::send('user.sales.customers.mailexistingcustomerinvite', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });
        }

        return redirect()->route('user.customermanagement.mycustomer.customerinvited')->with('success','Invitation email had sent.');

    }

    // customer invited 
    public function customerInvitedIndex(){

        $user = Auth::getUser();
        $companyId = $user->company->id; 

        $i = 0;
        
        // $customerList = InvitedCustomer::where('company_id', 1)->orderBy('customer_company_name')->get();

        $customerList = DB::table('invited_customers')
        ->select('users.first_name', 'users.last_name', 'invited_customers.customer_company_name', 'invited_customers.customer_first_name', 'invited_customers.customer_last_name', 'invited_customers.customer_email', 'invited_customers.created_at')
        ->leftJoin('users', 'users.id', '=', 'invited_customers.company_salesperson_id')
        ->where('invited_customers.company_id', '=', $companyId)
        ->get();

        // dd($customerList);

        return view('user.sales.customers.customerinvited', compact('i', 'customerList'));
    }
}
