<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
//      $this->middleware('permission:role-create', ['only' => ['create','store']]);
//      $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 5;
        $permissions = Permission::orderBy('id','DESC')->paginate($page);
        return view('admin.permissions.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * $page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.permissions.create');
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
            'name' => 'required',
        ]);
        $permission  = Permission::create(['guard_name' => 'web', 'name' => $request->input('name')]);
        return redirect()->route('admin.users.permissions.index')
            ->with('success','Permission created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.show',compact('permission'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('admin.permissions.edit',compact('permission'));
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
            'name' => 'required'
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
        return redirect()->route('admin.users.permissions.index')
            ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('admin.users.permissions.index')
            ->with('success','Permission deleted successfully');
    }
}
