<?php

namespace App\Http\Controllers\Seller;
use App\Models\Bank;
use App\Models\Company;
use App\Models\CompanyBudgetRange;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Currency;
use App\Models\DocType;
use App\Models\Industry;
use App\Models\PhoneCountry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id;
        $company = Company::find($companyId);
        $myDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();

        if($company) {
            foreach($company->companyDocs as $document) {
                $myDocuments[$document->doc_type_id] = $document;
            }
        }
        $sst_document_list = DocType::where('type', 'SST')->get();
        $mySSTDocuments = [];
        if($company) {
            foreach($company->companyDocs as $document) {
                $mySSTDocuments[$document->doc_type_id] = $document;
            }
        }

        return view('seller.company.index',compact('company','myDocuments','document_list','mySSTDocuments','sst_document_list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function edit()
    {
        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id;
        $company = Company::find($companyId);
        $myDocuments = [];
        $document_list = DocType::where('type', 'SSM')->get();
        if($company) {
            foreach($company->companyDocs as $document) {
                $myDocuments[$document->doc_type_id] = $document;
            }
        }
        $sst_document_list = DocType::where('type', 'SST')->get();
        $mySSTDocuments = [];
        if($company) {
            foreach($company->companyDocs as $document) {
                $mySSTDocuments[$document->doc_type_id] = $document;
            }
        }

        $state = CountryState::all();
        $industry = Industry::all();
        $bank=Bank::all();
        return view('seller.company.edit',compact('company','myDocuments','document_list','mySSTDocuments','sst_document_list','industry','state','bank'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update( Company $company, Request $request)
    {

        $input = $request->all();

        if ($request->file('logo')||$request->file('sst_file')||$request->file('file')){
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


        if($docFiles = $request->file('file')) {
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
        return redirect()->route('seller.company.profile')
            ->with('success','Company updated successfully');
    }

}
