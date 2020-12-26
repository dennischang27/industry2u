<?php

namespace App\Http\Controllers\Admin;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

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
        $productcategories = ProductCategory::latest()->paginate(5);
        return view('admin.productcategories.index',compact('productcategories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productcategories.create');
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
        ProductCategory::create($request->all());
        return redirect()->route('admin.productcategories.index')
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
        return view('admin.productcategories.edit',compact('productcategory'));
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
            'detail' => 'required',
        ]);
        $productcategory->update($request->all());
        return redirect()->route('admin.productcategories.index')
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
