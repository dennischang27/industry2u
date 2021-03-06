<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
//use DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    //    $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
     //   $this->middleware('permission:product-create', ['only' => ['create','store']]);
      //  $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
      //  $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page =5;
        $brands = Brand::orderBy('name')->get();
        return view('admin.brands.index',compact('brands'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
            'name' => 'required|unique:brands,name',
            'slug' => 'required',
        ]);
        $input = $request->all();
        $input['slug'] =lowercase($input['slug']);

        if ($request->file('logo')){
            $optimizePath = storage_path("app/public/brands/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }
        if ($file = $request->file('logo'))
        {

                $img = Image::make($file->path());
                $destinationPath = storage_path("app/public/brands/");
                $image = time().rand(1,100).$input['slug'].$file->getClientOriginalExtension();
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save($destinationPath . $image);

                $input['logo'] = $image;
        }
        Brand::create($input);
        return redirect()->route('admin.ecommerce.brands.index')
            ->with('success','Brand created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show',compact('brand'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact('brand'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $id = $brand->id;
        request()->validate([
            'name' => 'required|unique:brands,name,'.$id,
            'slug' => 'required',
        ]);

        $input = $request->all();
        $input['slug'] =strtolower($input['slug']);
        if ($file = $request->file('logo'))
        {

            $img = Image::make($file->path());
            $destinationPath = storage_path("app/public/brands/");
            $image = time().rand(1,100).$input['slug'].$file->getClientOriginalExtension();
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($destinationPath . $image);

            $input['logo'] = $image;
        }
        $brand->update($input);
        return redirect()->route('admin.ecommerce.brands.index')
            ->with('success','Brand updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.ecommerce.brands.index')
            ->with('success','brand deleted successfully');
    }

//    public function getBrands(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = Brand::latest()->get();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                    return $actionBtn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//    }
}
