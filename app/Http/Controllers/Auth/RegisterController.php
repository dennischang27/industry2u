<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['code'])){
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'terms' => 'required'
            ]);
        }else{
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'terms' => 'required'
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(isset($data['code'])){
            // check if user or customer 
            if(isset($data['type'])){
                $isPurchaser = true;
                $customer = User::where('invitation_code', '=', $data['code'])->first();
                $customer->first_name = $data['first_name'];
                $customer->last_name = $data['last_name'];
                $customer->username = $data['email'];
                $customer->email = $data['email'];
                $customer->is_active = 1;
                $customer->status = 'active';
                $customer->password = Hash::make($data['password']);
                $customer->save();

                $purchaser_company = Company::where('user_id', '=', $customer->id)->first();
                $supplier_company = Company::where('user_id', '=', $customer->customer_invited_by)->first();

                DB::table('company_customers')->insert([
                    'company_id' => $supplier_company->id,
                    'company_salesperson_id' => $customer->customer_invited_by,
                    'purchaser_id' => $customer->id,
                    'purchaser_company_id' => $purchaser_company->id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

                return $customer;

            } else {
                $user = User::where('invitation_code', '=', $data['code'])->first();
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->username = $data['email'];
                $user->email = $data['email'];
                $user->is_active = 1;
                $user->status = 'active';
                $user->password = Hash::make($data['password']);
                $user->save();
                return $user;
            } 
        } else {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['email'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
