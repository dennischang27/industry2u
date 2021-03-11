<?php

namespace App\Http\Controllers\Admin;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{

    function __construct()
    {
    }

    public function index()
    {
        $industries = Industry::orderBy('name')->get();
        return view('admin.industries.index',compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {

        request()->validate(
            ['name' => 'required|unique:industries,name'],
            ['name.unique' => 'The industry name has already been used.']
        );
        $input = $request->all();

        $industry = Industry::create($input);
        return redirect()->route('admin.settings.industry.index')
            ->with('success','Industry '.$industry->name.' created successfully.');
    }


    public function show(Industry $industry)
    {
        return view('admin.industries.show',compact('industry'));
    }


    public function edit(Industry $industry)
    {
        return view('admin.industries.edit',compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $id = $industry->id;

        request()->validate(
            ['name' => 'required|unique:industries,name,'.$id,],
            ['name.unique' => 'This industry name has already been used.']
        );

        $input = $request->all();

        $industry->update($input);
        return redirect()->route('admin.settings.industry.index')
            ->with('success','Industry '.$industry->name.' updated successfully');
    }

    public function destroy(Industry $industry)
    {
        $industry_name = $industry->name;
        $industry->delete();
        return redirect()->route('admin.settings.industry.index')
            ->with('success','Industry '.$industry_name.' deleted successfully');
    }

}
