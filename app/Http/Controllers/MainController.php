<?php

namespace App\Http\Controllers;


use App\Models\Bank;
use App\Models\Company;
use App\Models\CompanyBudgetRange;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\DocType;
use App\Models\Industry;
use App\Models\User;
use App\Models\Currency;
use Auth;
use Illuminate\Http\Request;
use Image;
use Illuminate\Http\UploadedFile;
use DB;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function addcompany()
    {
        If(Auth::user()->is_buyer){
            return redirect()->route('user.company');
        };
        $country = Country::all();
        $state = CountryState::all();
        $currency = Currency::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $bank=Bank::all();
        $doc_types = DocType::where('type','SSM')->get();
		$doc_type_sst = DocType::where('type','SST')->get();
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('user.addcompany', compact('user', 'country', 'state', 'bank','companybudgetrange','doc_types', 'doc_type_sst', 'industry','currency'));
    }

    public function validatecompanypost(Request $request){
        $initial = $request->get('initial');
        $reg_no = $request->get('reg_no');
        $arr_error=array();

        if (Company::where('initial', '=', $initial)->count() > 0) {
            // initial found
            array_push($arr_error,"initial");
        }

        if (Company::where('reg_no', '=', $reg_no)->count() > 0) {
            // reg_no found
            array_push($arr_error,"reg_no");
        }

        return $arr_error;
    }

    public function addcompanypost(Request $request)
    {
		$this->validate(request(), [
            'initial' => 'required|unique:companies',
			'reg_no' => 'required|unique:companies',
        ]);

        $user = Auth::user();


        //$input = $request->all();
		$input = $request->except(['bank_id','bank_account','sst_no']);
        $input["user_id"] = $user->id;
		$input["initial"] = strtoupper(request('initial'));
		
		if(isset($input["is_seller"])){
			$input["is_seller"] = 1;
		}else{
			$input["is_seller"] = 0;
		}
		
		if(isset($input["is_buyer"])){
			$input["is_buyer"] = 1;
		}else{
			$input["is_buyer"] = 0;
		}
		
        $company = Company::create($input);
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


        if($docFiles =  $request->file('file')) {
            foreach($docFiles as $key => $doc) {
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
        $user->is_buyer = $input["is_buyer"];
        $user->is_seller = $input["is_seller"];
        $user->save();

        $model_has_roles = DB::table('model_has_roles')->where('role_id','1')->where('model_id', $user->id)->first();

        if(!$model_has_roles){
             //user is not found
             DB::table('model_has_roles')->insert([
                 ['role_id' => '1', 'model_type' => 'App\Models\User', 'model_id' => $user->id]
             ]);
        }

        DB::table('company_users')->insert([
            ['user_id' => $user->id, 'company_id' => $company->id]
        ]);

        return redirect()->route('user.company')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }

    public function purchaseraddcompanypost(Request $request){

		$this->validate(request(), [
            'initial' => 'required|unique:companies',
			'reg_no' => 'required|unique:companies',
        ]);

        $user = Auth::user();
		$input = $request->except(['bank_id','bank_account','sst_no']);
        $input["user_id"] = $user->id;
		$input["initial"] = strtoupper(request('initial'));
        $input["is_seller"] = 0;
        $input["is_buyer"] = 1;
		
        $company = Company::create($input);
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


        if($docFiles =  $request->file('file')) {
            foreach($docFiles as $key => $doc) {
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
        $user->is_buyer = 1;
        $user->is_seller = 0;
        $user->save();

        $model_has_roles = DB::table('model_has_roles')->where('role_id','1')->where('model_id', $user->id)->first();

        if(!$model_has_roles){
             //user is not found
             DB::table('model_has_roles')->insert([
                 ['role_id' => '1', 'model_type' => 'App\Models\User', 'model_id' => $user->id]
             ]);
        }

        DB::table('company_users')->insert([
            ['user_id' => $user->id, 'company_id' => $company->id]
            ]);

        // update user table
        $customerId = Auth::user()->id;
        $customer = User::where('id', $customerId)->first();
        $customer->invite_source = '';
        $customer->dedsignation_id = 1;
        $customer->save();

        return redirect()->route('user.company')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }

    public function applyforseller()
    {
        If(Auth::user()->is_seller){
            return redirect()->route('seller.company.profile');
        };
        $country = Country::all();
        $state = CountryState::all();
        $currency = Currency::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $doc_types = DocType::where('type','SSM')->get();
        $doc_type_sst = DocType::where('type','SST')->get();
        $bank=Bank::all();
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('user.sellerformapply', compact('user', 'country','doc_types','doc_type_sst', 'state', 'bank','companybudgetrange', 'industry','currency'));
    }

    public function applyforsellerpost(Request $request)
    {
		$this->validate(request(), [
            'initial' => 'required|unique:companies',
			'reg_no' => 'required|unique:companies',
        ]);
		
        $user = Auth::user();

        $input = $request->all();
        $input["user_id"] = $user->id;
		$input["initial"] = strtoupper(request('initial'));
		
		if(isset($input["is_seller"])){
			$input["is_seller"] = 1;
		}else{
			$input["is_seller"] = 0;
		}
		
		if(isset($input["is_buyer"])){
			$input["is_buyer"] = 1;
		}else{
			$input["is_buyer"] = 0;
		}
		
        $company = Company::create($input);

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


        if($docFiles = $request->file('file')) {
            foreach($docFiles as $key => $doc) {
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
        
        $user->is_buyer = $input["is_buyer"];
        $user->is_seller = $input["is_seller"];
        $user->save();

        $model_has_roles = DB::table('model_has_roles')->where('role_id','1')->where('model_id', $user->id)->first();

        if(!$model_has_roles){
             //user is not found
             DB::table('model_has_roles')->insert([
                 ['role_id' => '1', 'model_type' => 'App\Models\User', 'model_id' => $user->id]
             ]);
        }

        DB::table('company_users')->insert([
            ['user_id' => $user->id, 'company_id' => $company->id]
        ]);

        //return redirect()->route('seller.company.profile')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
		return redirect()->route('user.company')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }


    public function upgradetoseller()
    {
        If(Auth::user()->is_seller){
            return redirect()->route('seller.company.profile');
        };
        $country = Country::all();
        $state = CountryState::all();
        $currency = Currency::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $doc_type_ssm = DocType::where('type','SSM')->get();
        $doc_type_sst = DocType::where('type','SST')->get();
        $bank=Bank::all();
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();

        $company = Company::where('user_id', $user->id)->first();
        $myssmDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();
        if($company) {
            foreach($company->companyDocs as $document) {
                $myssmDocuments[$document->doc_type_id] = $document;
            }
        }
        return view('user.sellerformupgrade', compact('user', 'myssmDocuments','company', 'country','doc_type_ssm','doc_type_sst', 'state', 'bank','companybudgetrange', 'industry','currency'));
    }

    public function upgradetosellerpost(Company $company, Request $request)
    {

        $user = Auth::user();
        $input = $request->all();
        $input["is_seller"] = 1;
        $input["is_buyer"] = 1;

        if ($request->file('logo')||$request->file('sst_file')){
            $optimizePath = storage_path("app/public/companies/".$company->id."/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }

        $company->update($input);
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
        $user->is_buyer = 1;
        $user->is_seller = 1;
        $user->save();

        return redirect()->route('seller.company.profile')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
     }
}
