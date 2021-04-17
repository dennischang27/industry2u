<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Term;
use DB;
use DataTables;

class TermController extends Controller{
    //
    public function index(){

        $user = Auth::getUser();
        $companyId = $user->companyMember->company_id;
        $terms = Term::where('company_id', $companyId)->first();
        return view('user.term.index', compact('terms'));
    }
    public function create()
    {
        return view('user.term.add');
    }

    public function store(Request $request)
    {

        $user = Auth::getUser();
        $company_id = $user->companyMember->company_id;
        request()->validate([
            'code' => 'required',
            'description' => 'required',
            'days' => 'required',
        ]);
        $input = $request->all();
        $input['company_id'] = $company_id;
        Term::create($input);
        return redirect()->route('user.term.index')
            ->with('success','Payment term created successfully. ');
    }

    public function edit(Term $term)
    {
        return view('user.term.edit', compact('term'));
    }

    public function update(Term $term,Request $request)
    {
        request()->validate([
            'code' => 'required',
            'description' => 'required',
            'days' => 'required',
        ]);

        $input = $request->all();

        $term->update($input);
        return redirect()->route('user.term.index')
            ->with('success','Payment term updated successfully');
    }

    public function destroy(Term $term)
    {

        $term->delete();
        return redirect()->route('user.term.index')
            ->with('success','Payment term deleted successfully');
    }
    public function getterms(Request $request)
    {
        $user = Auth::getUser();
        $company_id = $user->companyMember->company_id;

        if ($request->ajax()) {
            $data = Term::where('company_id',$company_id)
              ->get();
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="btn  btn-xs btn-primary" href="'. route('user.term.edit',$row->id).'">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deletecreditterm'.$row->id.'">Delete</button>
                                            <div id="deletecreditterm'.$row->id.'" class="delete-modal modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="delete-icon"></div>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                            <p>Do you really want to delete this Payment term? This process cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="'.route('user.term.destroy',$row->id).'" class="pull-right">
                                                                '.csrf_field().'
                                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
