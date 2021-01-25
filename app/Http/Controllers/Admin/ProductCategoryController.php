<?php

namespace App\Http\Controllers\Admin;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Image;

class ProductCategoryController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $productcategories = ProductCategory::orderBy('name')->paginate(5);
        return view('admin.productcategories.index',compact('productcategories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = ProductCategory::where('parent_id', null)->orderBy('name')->get();
        return view('admin.productcategories.create', compact('categories'));
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
        if ($file = $request->file('image'))
        {

            $img = Image::make($file->path());
            $destinationPath = storage_path("app/public/categories/");
            $image = time().rand(1,100).$file->getClientOriginalName();
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($destinationPath . $image);

            $input['image'] = $image;
        }
        $Productcat = ProductCategory::create($input);
        return redirect()->route('admin.productcategories.show',$Productcat)
            ->with('success','Product category created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productcategory)
    {
        return view('admin.productcategories.show',compact('productcategory'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productcategory)
    {

        $categories = ProductCategory::where('parent_id', null)->orderBy('name')->get();
        return view('admin.productcategories.edit',compact('productcategory', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productcategory)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $input = $request->all();
        $input["slug"] = preg_replace('/\s+/', '_', $input['slug']);
        if ($file = $request->file('image'))
        {

            $img = Image::make($file->path());
            $destinationPath = storage_path("app/public/categories/");
            $image = time().rand(1,100).$file->getClientOriginalName();
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($destinationPath . $image);

            $input['image'] = $image;
        }
        $productcategory->update($input);
        return redirect()->route('admin.productcategories.show', $productcategory)
            ->with('success','Product Category updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productcategory)
    {
        $productcategory->delete();
        return redirect()->route('admin.productcategories.index')
            ->with('success','Product Category deleted successfully');
    }
}
