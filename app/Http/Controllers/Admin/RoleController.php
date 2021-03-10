<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Departments;
use DB;

class RoleController extends Controller
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
        $page =5;
        $roles = Role::select('roles.*', 'departments.name as department_name')->leftJoin('departments', function($join) {
					$join->on('roles.department_id', '=', 'departments.id');
				})->orderBy('roles.id','DESC')->paginate($page);
        return view('admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * $page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
		$departments = Departments::all();
        return view('admin.roles.create',compact('permission','departments'));
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
            'name' => 'required|unique:roles,name',
			'department' => 'required',
            'permission' => 'required',
        ]);
        $is_seller = $request->input('is_seller');
        $is_buyer = $request->input('is_buyer');
        if (isset($is_seller) ){
            $input['is_seller'] = "1";
        } else {
            $input['is_seller'] = '0';
        }

        if (isset($is_buyer)){
            $input['is_buyer'] = "1";
        } else {
            $input['is_buyer'] = '0';
        }
        $role = Role::create(['guard_name' => 'web','name' => $request->input('name'),'department_id' => $request->input('department'),
            'is_buyer'=> $input['is_buyer'], 'is_seller'=> $input['is_seller']]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.users.roles.index')
            ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

		
		$role = Role::select('roles.*', 'departments.name as department_name')->leftJoin('departments', function($join) {
					$join->on('roles.department_id', '=', 'departments.id');
				})
				->where("roles.id",$id)
				->first();
				
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('admin.roles.show',compact('role','rolePermissions'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
		$departments = Departments::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit',compact('role','permission','rolePermissions','departments'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);
        $is_seller = $request->input('is_seller');
        $is_buyer = $request->input('is_buyer');
        if (isset($is_seller) ){
            $input['is_seller'] = "1";
        } else {
            $input['is_seller'] = '0';
        }

        if (isset($is_buyer)){
            $input['is_buyer'] = "1";
        } else {
            $input['is_buyer'] = '0';
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->is_seller = $input['is_seller'];
        $role->is_buyer = $input['is_buyer'];
		$role->department_id = $request->input('department');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.users.roles.index')
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
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin.users.roles.index')
            ->with('success','Role deleted successfully');
    }
}
