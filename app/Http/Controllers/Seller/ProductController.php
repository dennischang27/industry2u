<?php

namespace App\Http\Controllers\Seller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\AttributeMeasurement;
use App\Models\Brand;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use Image;

class ProductController extends Controller
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
        $products = Product::latest()->paginate(5);
        return view('seller.products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = ProductCategory::all();
        $attributes = Attribute::all();
        return view('seller.products.create', compact('brands', 'categories', 'attributes'));
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
            'series_no' => 'required',
            'description' => 'required',
        ]);
        $user = Auth::user();
        $input = $request->all();
        $input['company_id'] = $user->company->id;
        $input['user_id'] = $user->id;
        if($input['sub_category_id']){
            $input['category_id'] = $input['sub_category_id'];
        }else{
            $input['category_id'] = $input['main_category_id'];
        }

        $product = Product::create($input);
        if(isset($input['attr'])) {
            foreach($input['attr'] as $index => $id) {
                $attribute = Attribute::get()->find($index);
                if($id){
                    if(isset($input['unit'][$index])){
                        $product->productAttribute()->create([
                            'value' => $id,
                            'attribute_id' => $index,
                            'product_id' => $product->id,
                            'attribute_measurement_id' => $input['unit'][$index]
                        ]);

                    }
                    else{
                        $product->productAttribute()->create([
                            'value' => $id,
                            'attribute_id' => $index,
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }
        }

        if ($request->file('image_thumbnail')){
            $optimizePath = storage_path("app/public/products/".$product->id."/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }

        if ($file = $request->file('image_thumbnail')) {

            $optimizeImage = Image::make($file);


            $image_thumbnail = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image_thumbnail, 90);

            $logo_path = 'products/' . $product->id.'/'.$image_thumbnail;
            $product->productImage()->create([
                'path' => $logo_path,
                'name' => 'image_thumbnail',
                'product_id' => $product->id,
            ]);

        }

        if ($file = $request->file('image1')) {

            $optimizeImage = Image::make($file);


            $image1 = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image1, 90);

            $logo_path = 'products/' . $product->id.'/'.$image1;
            $product->productImage()->create([
                'path' => $logo_path,
                'name' => 'image1',
                'product_id' => $product->id,
            ]);

        }
        if ($file = $request->file('image2')) {

            $optimizeImage = Image::make($file);


            $image2 = time() . $file->getClientOriginalName();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image2, 90);

            $logo_path = 'products/' . $product->id.'/'.$image2;
            $product->productImage()->create([
                'path' => $logo_path,
                'name' => 'image2',
                'product_id' => $product->id,
            ]);

        }

        if($docFiles = $request->file('specification')) {
            $path = $docFiles->storeAs('products/' . $product->id,  "specification." . $docFiles->getClientOriginalExtension(), 'public');

            $product->productAttachment()->create([
                'file_path' => $path,
                'name' => 'specification',
                'product_id' => $product->id,
            ]);

        }

        if($docFiles = $request->file('dimension')) {
            $path = $docFiles->storeAs('products/' . $product->id,  "dimension." . $docFiles->getClientOriginalExtension(), 'public');

            $product->productAttachment()->create([
                'file_path' => $path,
                'name' => 'dimension',
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('seller.products.index')
            ->with('success','Product created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('seller.products.show',compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('seller.products.edit',compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        $product->update($request->all());
        return redirect()->route('seller.products.index')
            ->with('success','Product updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('seller.products.index')
            ->with('success','Product deleted successfully');
    }
}
