<?php

namespace App\Http\Controllers\Admin;
use App\Models\Attribute;
use App\Models\AttributeMeasurement;
use Illuminate\Http\Request;
use Image;

class AttributeMeasurementController extends Controller
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
        $attributemeasurements = AttributeMeasurement::orderBy('name')->paginate(5);
        return view('admin.attributemeasurements.index',compact('attributemeasurements'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $attributemeasurements = AttributeMeasurement::orderBy('name')->get();
        return view('admin.attributemeasurements.create', compact('attributemeasurements'));
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
            'name' => 'required'
        ]);
        $input = $request->all();
        $input['min'] = 0;
        $input['max']= 0;
        $attributemeasurements = AttributeMeasurement::create($input);
        return redirect()->route('admin.ecommerce.attributemeasurement.show',$attributemeasurements)
            ->with('success','Product attribute created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeMeasurement $attributemeasurement)
    {
        return view('admin.attributemeasurements.show',compact('attributemeasurement'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeMeasurement $attributemeasurement)
    {


        return view('admin.attributemeasurements.edit',compact('attributemeasurement'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeMeasurement $attributemeasurement)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $input = $request->all();

        $attributemeasurement->update($input);
        return redirect()->route('admin.ecommerce.attributemeasurement.show', $attributemeasurement)
            ->with('success','Product attribute unit updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeMeasurement $attributemeasurement)
    {
        $attributemeasurement->delete();
        return redirect()->route('admin.ecommerce.attributemeasurement.index')
            ->with('success','Product Attribute unit deleted successfully');
    }

    public function ajaxupdate(Request $request,$id)
    {

        $getval = $request->newval;


        $run_q = AttributeMeasurement::where('id','=',$id)->update(['name' => $getval]);

        if($run_q)
        {
            return "<div class='well custom-well'>Unit name Changed to $getval succesfully !</div>" ;
        }else {

            return "<div class='well custom-well'>Error In Updating Unit !</div>" ;
        }



    }

    public function ajaxdestroy(Request $request,$id)
    {
        $getval = $request->newval;
        $run_q = AttributeMeasurement::findOrFail($id)->delete();

        if($run_q)
        {
            return "<div class='well custom-well'> unit $getval deleted succesfully !</div>" ;
        }else {

            return "<div class='well custom-well'>Error In Deleting the Unit !</div>" ;
        }
    }

    public function ajaxstore(Request $request,$id)
    {


        $getval = $request->newval;
        if($getval==''){
            return "<div class='well custom-well'>Name is required!</div>" ;
        }
        $proattr = Attribute::findorfail($id);
        $newvalue = new AttributeMeasurement;

        $findsameproval = AttributeMeasurement::where('name','=',$getval)->where('id','=',$id)->first();

        if (isset($findsameproval)) {
            if (strcasecmp($findsameproval->name, $getval) == 0) {
                return "<div class='well custom-well'>Name is already there !</div>" ;
            }
        }else
        {
            $newvalue->name = $getval;
            $newvalue->attribute_id = $id;
            $newvalue->min = 0;
            $newvalue->max = 0;
            $newvalue->save();
        }

        return "<div class='well custom-well'>Unit measurement ".$newvalue->name." for Attribute ".$proattr->name." created succesfully ! </div>" ;

    }
}
