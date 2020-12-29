<?php

namespace App\Http\Controllers;


use App\Models\Bank;
use App\Models\Company;
use App\Models\CompanyBudgetRange;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Industry;
use App\Models\User;
use App\Models\Currency;
use Auth;
use Illuminate\Http\Request;
use Image;


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
        $country = Country::all();
        $state = CountryState::all();
        $currency = Currency::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $bank=Bank::all();
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('user.addcompany', compact('user', 'country', 'state', 'bank','companybudgetrange', 'industry','currency'));
    }
    public function addcompanypost(Request $request)
    {

        $user = Auth::user();


        $input = $request->all();
        $input["user_id"] = $user->id;
        $company = Company::create($input);

        if ($file = $request->file('logo')) {

            $optimizeImage = Image::make($file);
            $optimizePath = storage_path("app/public/company/".$company->id."/");
            if( ! \File::isDirectory($optimizePath) ) {

                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

                \File::makeDirectory($optimizePath, 493, true);
            }

            $logo = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $logo, 90);

            $input['logo'] = $logo;

        }
        $company->logo = $logo;
        $company->save();
        $user->is_seller = 1;
        $user->save();
        return redirect()->route('seller.company.profile')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }

    public function applyforseller()
    {
        $country = Country::all();
        $state = CountryState::all();
        $currency = Currency::all();
        $industry = Industry::all();
        $companybudgetrange = CompanyBudgetRange::all();
        $bank=Bank::all();
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('user.applysellerform', compact('user', 'country', 'state', 'bank','companybudgetrange', 'industry','currency'));
    }

    public function applyforsellerpost(Request $request)
    {

        $user = Auth::user();


        $input = $request->all();
        $input["user_id"] = $user->id;
        $company = Company::create($input);

        if ($file = $request->file('logo')) {

            $optimizeImage = Image::make($file);
            $optimizePath = storage_path("app/public/company/".$company->id."/");
            if( ! \File::isDirectory($optimizePath) ) {

                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

                \File::makeDirectory($optimizePath, 493, true);
            }

            $logo = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $logo, 90);

            $input['logo'] = $logo;

        }
        $company->logo = $logo;
        $company->save();
        $user->is_seller = 1;
        $user->save();
        return redirect()->route('seller.company.profile')->with(['message' => "You had registered your company profile.", "icon" => "success"]);
    }
}
