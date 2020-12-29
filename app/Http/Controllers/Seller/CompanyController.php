<?php

namespace App\Http\Controllers\Seller;
use App\Models\Company;
use App\Models\CompanyBudgetRange;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\PhoneCountry;

use Illuminate\Http\Request;

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
        $company = Company::latest();
        return view('seller.company.index',compact('company'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function edit(Company $company)
    {
        return view('seller.company.edit',compact('company'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        request()->validate([
            'name' => 'required',
            'reg_no' => 'required',
        ]);
        $company->update($request->all());
        return redirect()->route('seller.company.index')
            ->with('success','Company updated successfully');
    }

}
