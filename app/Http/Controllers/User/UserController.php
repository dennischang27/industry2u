<?php

namespace App\Http\Controllers\User;

use App\Models\Bank;
use App\Models\CompanyBudgetRange;
use App\Models\CountryState;
use App\Models\Industry;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Response;
use stdClass;
use Validator;
use Auth;
use App\Models\Company;
use App\Models\User;
use App\Models\DocType;
use App\Models\Departments;
use Carbon\Carbon;
use Hash;
use Image;
use App\Rules\MatchOldPassword;
use Spatie\Permission\Models\Role;
use Redirect;
use App\Models\Designations;
use App\Models\CompanyUser;
use Session;
use Mail;
use DB;

class UserController extends Controller
{
	const URL = "";

	public function account(Request $request)
	{
		$user = parent::getUser();
        $code = '';

        if(null !== $request->input('code')){
            $code = $request->input('code');
        }

        if($user['status'] == 'pending join'){
            $code = $user['invitation_code'];
        }

		return view('user.account', ['user' => $user,'code' => $code]);
	}

	public function profile() {
		$user = parent::getUser();

		return view('user.profile',compact('user'));
	}

    private function validateProfile($data) {
        $rules = [
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string']
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }
    public function updateprofile(User $user) {

	    $this->validate(request(), [
            'last_name' => 'required',
            'first_name' => 'required',
        ]);


        $user->last_name = request('last_name');
        $user->first_name = request('first_name');
        $user->mobile = request('mobile');

        $user->save();

            return redirect()->route('user.profile')
                ->with('success','User profile has been updated.');

    }
    public function company() {
        $user = parent::getUser();
        $company_user = CompanyUser::where('user_id', $user->id)->first();
        $company = Company::where('id', $company_user->company_id)->first();
        $myDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();
        if($company) {
            foreach($company->companyDocs as $document) {
                $myDocuments[$document->doc_type_id] = $document;
            }
        }
        return view('user.companyprofile',compact('company','myDocuments', 'document_list'));
    }

    public function companyedit() {
        $user = parent::getUser();
        $company_user = CompanyUser::where('user_id', $user->id)->first();
        $company = Company::where('id', $company_user->company_id)->first();
        $state = CountryState::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $myDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();
        if($company) {
            foreach($company->companyDocs as $document) {
                $myDocuments[$document->doc_type_id] = $document;
            }
        }
        return view('user.companyprofile_edit',compact('company','state','industry','myDocuments', 'document_list','companybudgetrange'));
    }

    public function companyupdate(Company $company, Request $request)
    {

        $user = Auth::user();

        $input = $request->all();


        $company->update($input);
        if ($request->file('logo')||$request->file('file')){
            $optimizePath = storage_path("app/public/companies/".$company->id."/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }
        if ($file = $request->file('logo')) {

            $optimizeImage = Image::make($file);


            $logo = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $logo, 90);

            $logo_path = 'companies/' . $company->id.'/'.$logo;

            $company->logo = $logo_path;
            $company->save();

        }


        if( $docFiles = $request->file('file')) {
            foreach($docFiles as $key => $doc) {
                if($doc) {
                    $doc_type = DocType::find($key);

                    if($doc_type) {
                        $path = $doc->storeAs('companies/' . $company->id, $doc_type->name . "." . $doc->getClientOriginalExtension(), 'public');

                        $document = $company->companyDocs->where('doc_type_id', $key)->first();
                        if($document) {
                            $document->update([
                                'file_path' =>  $path,
                            ]);
                        } else {
                            $company->CompanyDocs()->create([
                                'file_path' => $path,
                                'doc_type_id' => $doc_type->id,
                            ]);
                        }

                    }
                }
            }
        }

        if($sstdocFiles =  $request->file('sstfile')) {
            foreach($sstdocFiles as $key => $doc) {
                if($doc) {
                    $doc_type = DocType::find($key);

                    if($doc_type) {
                        $path = $doc->storeAs('companies/' . $company->id, $doc_type->name . "." . $doc->getClientOriginalExtension(), 'public');

                        $company->CompanyDocs()->create([
                            'file_path' => $path,
                            'doc_type_id' => $doc_type->id,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('user.company')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }
    public function changepassword() {
        $user = parent::getUser();

        return view('user.change-password', ['user' => $user]);
    }

    public function postchangepassword(User $user) {



        $this->validate(request(), [
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm_password' => ['same:password'],

        ]);
        $user->password =  Hash::make(request('password'));

        return redirect()->route('user.changepassword')
            ->with('success','User password has been updated.');
    }

	public function invite(Request $request) {
		$user = parent::getUser();
		//$roles = Role::where('name', '!=' , 'Admin')->where('name', '!=' , 'Sales')->get();
        $departments = Departments::where('name', '!=' , 'Admin')->get();
		$designations = "";

		$errors = Session::get('errors');
		if($errors){
				$designations = Role::where('department_id', '=', $request->old('department'))->get();
		}

		return view('user.invite', compact('user','departments','designations'));
	}

    public function manage(Request $request) {
		$user = parent::getUser();
        $users = User::where('user_admin_id', $user->id)->get();
        $i = 0;

        /*if($user->hasRole('Admin')){
            $users = User::where('user_admin_id', $user->id)->get();
            echo 'Admin';
        }elseif($user->hasRole('Moderator')){
            echo 'Moderator';
        }*/

		return view('user.manage', compact('users','i'));
	}

    public function manageedit(Request $request) {
        $user_id = $request->user;
        $user = User::where('id', $user_id)->first();
        $departments = Departments::where('name', '!=' , 'Admin')->get();
        $designations = Role::where('name', '!=' , 'Admin')->get();
        $status = ['active','inactive'];
        return view('user.manage_edit', compact('user','departments','designations','status'));
    }

    public function manageeditupdate(User $user, Request $request) {
        $this->validate(request(), [
            'department_id' => 'required',
			'designation_id' => 'required',
            'status' => 'required',
        ]);

        $user = User::where('id', $user->id)->first();
        $user->department_id = request('department_id');
        $user->designation_id = request('designation_id');
        $user->status = request('status'); 
        $user->save();

        return redirect()->route('user.manage')->with('success','Update user successfully.');
    }

    public function reporting(Request $request) {
		$user = parent::getUser();
        $users = User::where('user_admin_id', $user->id)->where('status', 'active')->get();
        $i = 0;
		return view('user.reporting', compact('users','i'));
	}

    public function reportingedit(Request $request) {
        $login_user = parent::getUser();
        $user_id = $request->user;
        $user = User::where('id', $user_id)->first();

        if($user->designation_id == 2 || $user->designation_id == 3 || $user->designation_id == 4){
            // Is Moderator, Get Admin List
            $reportings = User::where('id', $login_user->id)->get();
        }elseif($user->designation_id == 5){
            // Is Sales Manager, Get Moderator List
            $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 2)->orWhere('designation_id', 3)->get();
            if($reportings->count() == 0){
                $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 1)->get();
            }
        }elseif($user->designation_id == 6 || $user->designation_id == 9 || $user->designation_id == 10){
            // Is Puchasing Manager/Engineer/Clerical Staff, Get Moderator List
            $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 2)->orWhere('designation_id', 4)->get();
            if($reportings->count() == 0){
                $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 1)->get();
            }
        }elseif($user->designation_id == 7){
            // Is Sales Executive, Get Sales Manager List
            $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 5)->get();
            if($reportings->count() == 0){
                $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 2)->orWhere('designation_id', 3)->get();
                if($reportings->count() == 0){
                    $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 1)->get();
                }
            }
        }elseif($user->designation_id == 8){
            // Is Puchasing Executive, Get Puchasing Manager List
            $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 6)->get();
            if($reportings->count() == 0){
                $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 2)->orWhere('designation_id', 4)->get();
                if($reportings->count() == 0){
                    $reportings = User::where('user_admin_id', $login_user->id)->where('designation_id', 1)->get();
                }
            }
        }

        return view('user.reporting_edit', compact('user','reportings'));
    }

    public function reportingupdate(User $user, Request $request) {
        $this->validate(request(), [
            'reporting' => 'required',
        ]);

        $user_id = $request->user->id;
        $reporting = request('reporting');

        echo $user_id . '<br/>';
        echo $reporting;

        $user = User::where('id', $user_id)->first();
        $user->user_reporting_id = $reporting;
        $user->save();

        return redirect()->route('user.reporting')->with('success','Update user successfully.');
    }

	function generateRandomString($length = 10) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function joincompany(User $user, Request $request) {
        $user->status = 'active';
        $user->save();
        return redirect()->route('user.account')->with('success','Join successfully.');
    }

	public function sendinvitation(User $user, Request $request) {
	    $login_user = parent::getUser();
	    $login_user->companyMember->company_id;
	    
	    $login_company = Company::where('id', $login_user->companyMember->company_id)->first();

        $this->validate(request(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => ['required', 'string', 'email', 'max:255'],
                'designation' => 'required',
                'department' => 'required',
        ]);

        $invitation_code = $this->generateRandomString(50);

        $userdata = User::where('email', '=', $request->email)->first();
        if ($userdata === null) {
            echo "Email not exist <br/>";
            // user doesn't exist
            // store users table and model_has_roles table
            $new_user = new User;
            $new_user->title = '.';
            $new_user->first_name = $request->firstname;
            $new_user->last_name = $request->lastname;
            $new_user->username = $request->email;
            $new_user->email = $request->email;
            $new_user->password = '.';
            $new_user->is_active = 0;
            $new_user->is_company_admin = 0;
            $new_user->manage_company_admin = 0;
            $new_user->is_super_user = 0;
            $new_user->manage_supers = 0;

            if($request->designation == 3 || $request->designation == 5 || $request->designation == 7){
                // Seller
                $new_user->is_buyer = 0;
                $new_user->is_seller = 1;
            }elseif($request->designation == 4 || $request->designation == 6 || $request->designation == 8 || $request->designation == 9 || $request->designation == 10){
                // Buyer
                $new_user->is_buyer = 1;
                $new_user->is_seller = 0;
            }else{
                // Moderator
                $new_user->is_buyer = 1;
                $new_user->is_seller = 1;
            }
            
            $new_user->invitation_code = $invitation_code;
            $new_user->status = 'pending register';
            $new_user->designation_id = $request->designation;
            $new_user->department_id = $request->department;
            $new_user->user_admin_id = $user->id;
            $new_user->save();

            // add user roles
            DB::table('model_has_roles')->insert([
                ['role_id' => $request->designation, 'model_type' => 'App\Models\User', 'model_id' => $new_user->id]
            ]);

            // add company users
            DB::table('company_users')->insert([
                ['user_id' => $new_user->id, 'company_id' => $login_user->companyMember->company_id]
            ]);

            // Send invitation emails
            $mail["email"] = $request->email;
            $mail["subject"] = "Industry2u Registration Invitation";
            $mail["company"] = $login_company->name;
            $mail["invitation_code"] = $invitation_code;

            Mail::send('user.newusermail', $mail, function($message)use($mail) {
                $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
            });

            return redirect()->route('user.invite')->with('success','Invitation email had sent.');
        } else {
            // user exist
            if($userdata->is_buyer==0 && $userdata->is_seller==0){
                // General User
                // Update User Data
                if($request->designation == 3 || $request->designation == 5 || $request->designation == 7){
                    // Seller
                    $userdata->is_buyer = 0;
                    $userdata->is_seller = 1;
                }elseif($request->designation == 4 || $request->designation == 6 || $request->designation == 8 || $request->designation == 9 || $request->designation == 10){
                    // Buyer
                    $userdata->is_buyer = 1;
                    $userdata->is_seller = 0;
                }else{
                    // Moderator
                    $userdata->is_buyer = 1;
                    $userdata->is_seller = 1;
                }

                $userdata->invitation_code = $invitation_code;
                $userdata->status = 'pending join';
                $userdata->designation_id = $request->designation;
                $userdata->department_id = $request->department;
                $userdata->user_admin_id = $user->id;
                $userdata->save();

                // add user roles
                DB::table('model_has_roles')->insert([
                    ['role_id' => $request->designation, 'model_type' => 'App\Models\User', 'model_id' => $userdata->id]
                ]);

                // add company users
                DB::table('company_users')->insert([
                    ['user_id' => $userdata->id, 'company_id' => $login_user->companyMember->company_id]
                ]);

                // Send Invite User
                $mail["email"] = $request->email;
                $mail["subject"] = "Industry2u Registration Invitation";
                $mail["company"] = $login_company->name;
                $mail["invitation_code"] = $invitation_code;

                Mail::send('user.generalusermail', $mail, function($message)use($mail) {
                    $message->to($mail["email"], $mail['email'])->subject($mail['subject']);
                });

                return redirect()->route('user.invite')->with('success','Invitation email had sent.');
            }else{
                // Moderator
                return Redirect::back()->withInput()->withErrors(['message'=>'Invitation is failed! User Account has been registered with us']);
            }
        }
	}

	public function getdesignation(Request $request) {
	    $departmentid = $request->departmentid;
        $roles = Role::where('department_id', '=', $departmentid)->get();
			//$designations = Designations::where('roles_id', '=', $depatmentid)->get();
		return Response::json( $roles );
	}
	
	public function bankinfo() {
		$user = parent::getUser();
        $company = Company::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        $sst_file_path = '';
        $sst_file_name = '';

        if($company) {
            foreach($company->companyDocs as $document) {
                $myssmDocuments[$document->doc_type_id] = $document;
                if($document['doc_type_id'] == 4){
                    $sst_file_path = $document['file_path'];
                    $sst_file_name = $document->doc_type->name;
                }
            }
        }

        return view('user.bankinfo',compact('company','sst_file_path','sst_file_name'));
    }

    public function bankinfoadd() {
        $user = parent::getUser();
        $company = Company::where('user_id', $user->id)->first();
        $bank=Bank::all();
        $doc_type_sst = DocType::where('type','SST')->get();
        return view('user.bankinfo_add',compact('company','bank','doc_type_sst'));
    }

    public function bankinfoaddpost(Company $company, Request $request) {
        $this->validate(request(), [
            'bank_id' => 'required',
			'bank_account' => 'required',
        ]);

        $input = $request->all();
        $input["is_seller"] = 1;
        $company->update($input);

        if($sstdocFiles = $request->file('sstfile')) {
            foreach($sstdocFiles as $key => $doc) {
                if($doc) {
                    $doc_type = DocType::find($key);

                    if($doc_type) {
                        $path = $doc->storeAs('companies/' . $company->id, $doc_type->name . "." . $doc->getClientOriginalExtension(), 'public');

                        $document = $company->companyDocs->where('doc_type_id', $key)->first();
                        if($document) {
                            $document->update([
                                'file_path' =>  $path,
                            ]);
                        } else {
                            $company->CompanyDocs()->create([
                                'file_path' => $path,
                                'doc_type_id' => $doc_type->id,
                            ]);
                        }

                    }
                }
            }
        }

        $user = Auth::user();
        $user->is_seller = 1;
        $user->save();

        $user = parent::getUser();
        $company = Company::where('user_id', $user->id)->first();
        return redirect()->route("user.bankinfo");
    }
	
	public function bankinfoedit() {
        $user = parent::getUser();
        $company = Company::where('user_id', $user->id)->first();
        $bank=Bank::all();
        $doc_type_sst = DocType::where('type','SST')->get();
        return view('user.bankinfo_edit',compact('company','bank','doc_type_sst'));
    }

    public function becomepurchaser(Request $request) {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        $user->is_buyer = 1;
        $user->save();

        return redirect()->route('user.company')->with('success','Become Purchaser Successfully.');
    }
}
