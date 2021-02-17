<?php

namespace App\Http\Controllers\Admin;
use App\Models\Bank;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;

class CompanyController extends Controller
{

    function __construct()
    {
    }

    public function index(Request $request){

        $page =10;
        $data = Company::orderBy('id')->paginate($page);
        return view('admin.companies.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $page);
    }

    public function create(){

        return view('admin.companies.create');
    }

    public function store(Request $request){

    }

    public function show($id)
    {
        $company = Company::find($id);
        return view('admin.companies.show',compact('company'));
    }

    public function edit($id)
    {
        $company = Company::find($id);
        $banks = Bank::pluck('name', 'id');
        return view('admin.companies.edit',compact('company','banks'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

//        print_r("<pre>");
//        print_r($input);
//        print_r("</pre>");
      $company = Company::find($id);
//        print_r("<pre>");
//        print_r($company);
//        print_r("</pre>");
        $company->update($input);

//        print_r("<pre>");
//        print_r($company);
//        print_r("</pre>");
//        exit();
        return redirect()->route('admin.companies.index')
            ->with('success','Company updated successfully');
    }

}
