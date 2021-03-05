<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Departments;
use DB;

class DepartmentController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page =5;

        $departments = Departments::orderBy('id','DESC')
            ->paginate($page, array('departments.*'));

        return view('admin.departments.index',compact('departments'))
            ->with('i', ($request->input('page', 1) - 1) * $page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments',
        ]);

        $departments = new Departments;
        $departments->name = $request->name;
        $departments->save();

        return redirect()->route('admin.users.departments.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.departments.show');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Departments::find($id);
        return view('admin.departments.edit',compact('departments'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments',
        ]);

        $departments = Departments::find($id);
        $departments->name = $request->name;
        $departments->save();

        return redirect()->route('admin.users.departments.index')
            ->with('success','Department updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("departments")->where('id',$id)->delete();
        return redirect()->route('admin.users.departments.index')
            ->with('success','Department deleted successfully');
    }
}
