<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Designations;
use Spatie\Permission\Models\Role;
use DB;

class DesignationController extends Controller
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

        $designations = Designations::orderBy('id','DESC')
            ->leftJoin('roles', 'roles.id', '=', 'designations.roles_id')
            ->paginate($page, array('designations.*', 'roles.name as role_name'));

        return view('admin.designation.index',compact('designations'))
            ->with('i', ($request->input('page', 1) - 1) * $page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.designation.create',compact('roles'));
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
            'name' => 'required|unique:designations',
            'department' => 'required',
        ]);

        $designations = new Designations;
        $designations->name = $request->name;
        $designations->roles_id = $request->department;
        $designations->save();

        return redirect()->route('admin.users.designation.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Designations::find($id);
        return view('admin.designation.show',compact('role'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation = Designations::find($id);
        $roles = Role::get();
        return view('admin.designation.edit',compact('designation','roles'));
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
            'name' => 'required|unique:designations',
            'department' => 'required',
        ]);

        $designation = Designations::find($id);
        $designation->name = $request->name;
        $designation->roles_id = $request->department;
        $designation->save();

        return redirect()->route('admin.users.designation.index')
            ->with('success','Designation updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("designations")->where('id',$id)->delete();
        return redirect()->route('admin.users.designation.index')
            ->with('success','Designation deleted successfully');
    }
}
