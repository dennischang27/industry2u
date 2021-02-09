<?php

namespace App\Http\Controllers\Admin;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\ProductCategoryAttribute;
use App\Models\Attribute;
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

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $page =5;
        $productcategories = ProductCategory::orderBy('name')->get();
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
        return redirect()->route('admin.ecommerce.productcategories.show',$Productcat)
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

        $exAttributes  =[] ;
        if(count($productcategory->comAttributes)){
            foreach($productcategory->comAttributes as $procatAttribute){
                array_push($exAttributes,$procatAttribute->attribute_id);
            }
        }
        $categories = ProductCategory::where('parent_id', null)->orderBy('name')->get();
        $attributes = Attribute::whereNotIn('id', $exAttributes)->orderBy('name')->get();
        return view('admin.productcategories.edit',compact('productcategory', 'categories','attributes'));
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
        return redirect()->route('admin.ecommerce.productcategories.index', $productcategory)
            ->with('success','Product Category '.$input["name"].' updated successfully');
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
        return redirect()->route('admin.ecommerce.productcategories.index')
            ->with('success','Product Category deleted successfully');
    }

    public function attributeajaxdestroy(Request $request,$id)
    {
        $getval = $request->newval;
        $run_q = ProductCategoryAttribute::findOrFail($id)->delete();

        if($run_q)
        {
            return "<div class='well custom-well'> attribute $getval removed succesfully !</div>" ;
        }else {

            return "<div class='well custom-well'>Error In removed the attribute !</div>" ;
        }
    }

    public function attributeajaxstore(Request $request,$id)
    {
        $attrid = $request->newval;
        $proattr = Attribute::findorfail($attrid);
        $procat = ProductCategory::findorfail($id);
        $newvalue = new ProductCategoryAttribute();

        $findsameproval = ProductCategoryAttribute::where('attribute_id','=',$attrid)->where('category_id','=',$id)->first();

        if (isset($findsameproval)) {
            return "<div class='well custom-well'>Attribute is already added there !</div>" ;
        }else
        {
            $newvalue->category_id = $id;
            $newvalue->attribute_id = $attrid;
            $newvalue->save();
        }
        return "<div class='well custom-well'>Attribute ".$newvalue->name." added succesfully ! </div>" ;

    }
}
