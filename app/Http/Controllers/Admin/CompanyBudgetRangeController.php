<?php

namespace App\Http\Controllers\Admin;
use App\Models\CompanyBudgetRange;
use Illuminate\Http\Request;

class CompanyBudgetRangeController extends Controller
{

    function __construct()
    {
    }

    public function index()
    {
        $companybudgets = CompanyBudgetRange::orderBy('name')->get();
        return view('admin.companybudgets.index',compact('companybudgets'));
    }

    public function create()
    {
        return view('admin.companybudgets.create');
    }

    public function store(Request $request)
    {

        request()->validate(
            ['name' => 'required']
        );
        $input = $request->all();

        $industry = CompanyBudgetRange::create($input);
        return redirect()->route('admin.settings.companybudget.index')
            ->with('success','Industry '.$industry->name.' created successfully.');
    }


    public function show(CompanyBudgetRange $companybudget)
    {
        return view('admin.companybudgets.show',compact('companybudget'));
    }


    public function edit(CompanyBudgetRange $companybudget)
    {
        return view('admin.companybudgets.edit',compact('companybudget'));
    }

    public function update(Request $request, CompanyBudgetRange $companybudget)
    {
        $id = $companybudget->id;

        request()->validate(
            ['name' => 'required']
        );

        $input = $request->all();

        $companybudget->update($input);
        return redirect()->route('admin.settings.companybudget.index')
            ->with('success','Budget Range '.$companybudget->name.' updated successfully');
    }

    public function destroy(CompanyBudgetRange $companybudget)
    {
        $companybudget_name = $companybudget->name;
        $companybudget->delete();
        return redirect()->route('admin.settings.companybudget.index')
            ->with('success','Budget Range '.$companybudget_name.' deleted successfully');
    }

}
