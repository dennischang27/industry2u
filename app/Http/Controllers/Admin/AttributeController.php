<?php

namespace App\Http\Controllers\Admin;
use App\Models\Attribute;
use App\Models\AttributeMeasurement;
use Illuminate\Http\Request;
use Image;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $page = 5;
        $attributes = Attribute::orderBy('name')->get();
        return view('admin.attributes.index',compact('attributes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $attributemeasurements = AttributeMeasurement::orderBy('name')->get();
        return view('admin.attributes.create', compact('attributemeasurements'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        $input = $request->all();
        $input["slug"] = preg_replace('/\s+/', '_', $input['slug']);

        if($input["is_range"]){
            $input["type"] = 'number';
        }else{
            $input["type"] = 'text';
        }
        $Attribute = Attribute::create($input);
        if($input["is_range"]){
            return redirect()->route('admin.ecommerce.attributes.edit',$Attribute)
                ->with('success','Product attribute created successfully. Please add in unit measurement!');
        }else{
        return redirect()->route('admin.ecommerce.attributes.show',$Attribute)
            ->with('success','Product attribute created successfully.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show',compact('attribute'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {

        $attribute_measurements = AttributeMeasurement::orderBy('name')->get();
        return view('admin.attributes.edit',compact('attribute', 'attribute_measurements'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $input = $request->all();
        $input["slug"] = preg_replace('/\s+/', '_', $input['slug']);
        if($input["is_range"]){
            $input["type"] = 'number';
        }else{
            $input["type"] = 'text';
        }

        $attribute->update($input);
        return redirect()->route('admin.ecommerce.attributes.index', $attribute)
            ->with('success','Product attribute '.$input["name"] .'updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.ecommerce.attributes.index')
            ->with('success','Product Attribute deleted successfully');
    }
}
