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
use Carbon\Carbon;
use Hash;
use Image;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
	const URL = "";

	public function account()
	{
		$user = parent::getUser();

		return view('user.account', ['user' => $user]);
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
        $user->phone = request('phone');

        $user->save();

            return redirect()->route('user.profile')
                ->with('success','User profile has been updated.');

    }
    public function company() {
        $user = parent::getUser();
        $company = Company::where('user_id', $user->id)->first();
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
        $company = Company::where('user_id', $user->id)->first();
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

        if ($request->file('logo')){
            $logo = $request->file('logo');
        }
        if ($request->file('file')){
            $docFiles = $request->file('file');
        }




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
        $docFiles =  $request->file('file');


        if($docFiles) {
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

        $sstdocFiles =  $request->file('sstfile');
        if($sstdocFiles) {
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


}
