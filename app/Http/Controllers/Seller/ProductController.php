<?php

namespace App\Http\Controllers\Seller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductAttribute;
use App\Models\AttributeMeasurement;
use App\Models\Brand;
use App\Models\ProductCategoryAttribute;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use DataTables;
use DB;

use Str;

class ProductController extends Controller
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
    public function index()
    {
        // return view('seller.products.index');
        return view('user.sales.products.myproducts');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = ProductCategory::orderBy('name')->get();
        $attributes = Attribute::with(['attributemeasurement'])->orderBy('name')->get(['id', 'name', 'is_range']);

        $procatattributes = ProductCategoryAttribute::orderBy('category_id')->get(['category_id','attribute_id']);
        // return view('seller.products.create', compact('brands', 'categories', 'attributes', 'procatattributes'));

        return view('user.sales.products.addnewproduct', compact('brands', 'categories', 'attributes', 'procatattributes'));

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


        $input['slug']  = preg_replace('/[^a-zA-Z0-9\']/', '_',Str::limit($input['slug'], 30));
        $input['slug']  = str_replace("'", '', $input['slug'] );
        if($input['brand_id'] == 'Other') {
            $brand = Brand::create([
                'name' => $input['brand_name'],
                'description' => $input['brand_name'],
                'slug' => preg_replace('/\s+/', '_', $input['brand_name'])
            ]);
            $input['brand_id'] = $brand->id;
        }


        $product = Product::create($input);
        if ($request->file('image_thumbnail')){
            $optimizePath = storage_path("app/public/products/".$product->id."/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }

        if ($file = $request->file('image_thumbnail')) {

            $optimizeImage = Image::make($file);


            $image_thumbnail = "image_thumbnail." . $file->getClientOriginalExtension();
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


            $image1 = "image1." . $file->getClientOriginalExtension();
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


            $image2 = "image2." . $file->getClientOriginalExtension();
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


        if(isset($input['attributes'])) {

            foreach($input['attributes'] as $index => $id) {
                if($id == "Other") {

                    if(isset($input['attribute_type'][$index])){
                        $type = "number";
                    }else{
                        $type = "Text";
                    }
                    if(!isset($input['attribute_name'][$index])) {
                        continue;
                    }
                    $exattr = Attribute::where('name', $input['attribute_name'][$index])->first();

                    if(!$exattr) {
                        $attr = Attribute::create([
                            'name' => $input['attribute_name'][$index],
                            'slug' => preg_replace('/\s+/', '_', $input['attribute_name'][$index]),
                            'is_range' => isset($input['attribute_type'][$index]),
                            'type' => $type
                        ]);
                    }
                    else{
                        $attr=  $exattr;
                    }

                }else {
                    $attr = Attribute::all()->find($id);

                    if(!$attr) {
                        continue;
                    }
                }
                if($attr->is_range) {
                    if ($id == "Other"){

                        $value = $input['attribute_value'][$index];
                    }
                    else{
                        if(!isset($input['attribute_unit'][$index]) || !isset($input['attribute_range_value'][$index])) {
                            continue;
                        }
                        $value = $input['attribute_range_value'][$index];
                        if($input['attribute_unit'][$index] == 'Other') {
                            $attrmeasure = $attr->attributemeasurement()->create([
                                'min' => $value,
                                'max' => $value,
                                'name' => $input['attribute_unit_name'][$index],
                            ]);
                        } else {
                            $attrmeasure = $attr->attributemeasurement->find($input['attribute_unit'][$index]);

                            if($attrmeasure) {
                                if($attrmeasure->min > $value) {
                                    $attrmeasure->min = $value;
                                    $attrmeasure->save();
                                } else if($attrmeasure->max < $value) {
                                    $attrmeasure->max = $value;
                                    $attrmeasure->save();
                                }
                            } else {
                                continue;
                            }
                        }
                    }

                }else {
                    if(!isset($input['attribute_value'][$index])) {
                        continue;
                    }
                    $value = $input['attribute_value'][$index];
                }

                if($value){
                    if(isset($input['attribute_unit'][$index])){
                        $product->productAttribute()->create([
                            'value' => $value,
                            'attribute_id' => $attr->id,
                            'product_id' => $product->id,
                            'attribute_measurement_id' => $attrmeasure->id
                        ]);

                    }
                    else{
                        $product->productAttribute()->create([
                            'value' => $value,
                            'attribute_id' => $attr->id,
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }
        }




        return redirect()->route('seller.products.index')
            ->with('product_link', route('public.products.show',['id'=>$product->id, 'slug'=>$product->slug]))
            ->with('success','Product '.$product->name.' created successfully. ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return view('seller.products.show',compact('product'));
        return view('user.sales.products.showproduct',compact('product'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        $attributes = Attribute::with(['attributemeasurement'])->orderBy('name')->get(['id', 'name', 'is_range']);
        $productAttributes=[];
        if($product) {
            foreach($product->productAttribute as $attribute) {
                $productAttributes[$attribute->attribute_id] = $attribute;
            }
        }

        $images['image_thumbnail'] = $product->productImage->firstWhere('name', 'image_thumbnail');

        if($product->productImage->where('name', 'image1')){
            $images['image1'] = $product->productImage->where('name', 'image1');
        }
        if($product->productImage->where('name', 'image2')){
            $images['image2'] = $product->productImage->where('name', 'image2');
        }


        // return view('seller.products.edit',compact('product', 'brands', 'categories', 'attributes','images', 'productAttributes'));
        return view('user.sales.products.editproduct',compact('product', 'brands', 'categories', 'attributes','images', 'productAttributes'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product,Request $request)
    {

        request()->validate([
            'name' => 'required',
            'series_no' => 'required',
            'description' => 'required',
        ]);
        $user = Auth::user();
        $input = $request->all();

        $input['slug']  = preg_replace('/[^a-zA-Z0-9\']/', '_', Str::limit($input['slug'], 30));
        $input['slug']  = str_replace("'", '', $input['slug'] );

        if($input['brand_id'] == 'Other') {
            $brand = Brand::create([
                'name' => $input['brand_name'],
                'description' => $input['brand_name'],
                'slug' => preg_replace('/\s+/', '_', $input['brand_name'])
            ]);
            $input['brand_id'] = $brand->id;
        }



        $product->update($input);

        if(isset($input['attributes'])) {
            $product->productAttribute()->delete();
            foreach($input['attributes'] as $index => $id) {
                if($id == "Other") {
                    if(isset($input['attribute_type'][$index])){
                        $type = "number";
                    }else{
                        $type = "Text";
                    }
                    if(!isset($input['attribute_name'][$index])) {
                        continue;
                    }
                    $exattr = Attribute::where('name', $input['attribute_name'][$index])->first();

                    if(!$exattr) {
                        $attr = Attribute::create([
                            'name' => $input['attribute_name'][$index],
                            'slug' => preg_replace('/\s+/', '_', $input['attribute_name'][$index]),
                            'is_range' => isset($input['attribute_type'][$index]),
                            'type' => $type
                        ]);
                    }
                    else{
                        $attr=  $exattr;
                    }

                }else {
                    $attr = Attribute::all()->find($id);

                    if(!$attr) {
                        continue;
                    }
                }
                if($attr->is_range) {
                    if ($id == "Other"){

                        $value = $input['attribute_value'][$index];
                    }
                    else{
                        if(!isset($input['attribute_unit'][$index]) || !isset($input['attribute_range_value'][$index])) {
                            continue;
                        }
                        $value = $input['attribute_range_value'][$index];
                        if($input['attribute_unit'][$index] == 'Other') {
                            $attrmeasure = $attr->attributemeasurement()->create([
                                'min' => $value,
                                'max' => $value,
                                'name' => $input['attribute_unit_name'][$index],
                            ]);
                        } else {
                            $attrmeasure = $attr->attributemeasurement->find($input['attribute_unit'][$index]);

                            if($attrmeasure) {
                                if($attrmeasure->min > $value) {
                                    $attrmeasure->min = $value;
                                    $attrmeasure->save();
                                } else if($attrmeasure->max < $value) {
                                    $attrmeasure->max = $value;
                                    $attrmeasure->save();
                                }
                            } else {
                                continue;
                            }
                        }
                    }

                }else {
                    if(!isset($input['attribute_value'][$index])) {
                        continue;
                    }
                    $value = $input['attribute_value'][$index];
                }
                if($value){
                    if(isset($input['attribute_unit'][$index])){
                        $product->productAttribute()->create([
                            'value' => $value,
                            'attribute_id' => $attr->id,
                            'product_id' => $product->id,
                            'attribute_measurement_id' => $attrmeasure->id
                        ]);

                    }
                    else{
                        $product->productAttribute()->create([
                            'value' => $value,
                            'attribute_id' => $attr->id,
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }
        }

        if ($request->file('image_thumbnail')||$request->file('image1')||$request->file('image2')){
            $optimizePath = storage_path("app/public/products/".$product->id."/");
            if( ! \File::isDirectory($optimizePath) ) {
                \File::makeDirectory($optimizePath, 493, true);
            }
        }

        if ($file = $request->file('image_thumbnail')) {

            $optimizeImage = Image::make($file);


            $image_thumbnail = "image_thumbnail." . $file->getClientOriginalExtension();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image_thumbnail, 90);

            $logo_path = 'products/' . $product->id.'/'.$image_thumbnail;
            $product_image_thumbnail = $product->productImage->where('name', 'image_thumbnail')->first();
            if($product_image_thumbnail){
                $product_image_thumbnail->update([
                    'path' =>  $logo_path,
                ]);
            }
            else{
                $product->productImage()->create([
                    'path' => $logo_path,
                    'name' => 'image_thumbnail',
                    'product_id' => $product->id,
                ]);
            }


        }

        if ($file = $request->file('image1')) {

            $optimizeImage = Image::make($file);


            $image1 = "image1." . $file->getClientOriginalExtension();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image1, 90);

            $logo_path = 'products/' . $product->id.'/'.$image1;
            $product_image1 = $product->productImage->where('name', 'image1')->first();
            if($product_image1){
                $product_image1->update([
                    'path' =>  $logo_path,
                ]);
            }
            else{
                $product->productImage()->create([
                    'path' => $logo_path,
                    'name' => 'image1',
                    'product_id' => $product->id,
                ]);
            }

        }
        if ($file = $request->file('image2')) {

            $optimizeImage = Image::make($file);


            $image2 = "image2." . $file->getClientOriginalExtension();
            $optimizeImage->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image2, 90);

            $logo_path = 'products/' . $product->id.'/'.$image2;
            $product_image2 = $product->productImage->where('name', 'image2')->first();
            if($product_image2){
                $product_image2->update([
                    'path' =>  $logo_path,
                ]);
            }
            else{
                $product->productImage()->create([
                    'path' => $logo_path,
                    'name' => 'image2',
                    'product_id' => $product->id,
                ]);
            }

        }

        if($docFiles = $request->file('specification')) {
            $path = $docFiles->storeAs('products/' . $product->id,  "specification." . $docFiles->getClientOriginalExtension(), 'public');



            $product_specification = $product->productAttachment->where('name', 'specification')->first();

            if($product_specification){
                $product_specification->update([
                    'file_path' =>  $path,
                ]);
            }
            else{
                $product->productAttachment()->create([
                    'file_path' => $path,
                    'name' => 'specification',
                    'product_id' => $product->id,
                ]);

            }

        }

        if($docFiles = $request->file('dimension')) {
            $path = $docFiles->storeAs('products/' . $product->id,  "dimension." . $docFiles->getClientOriginalExtension(), 'public');

            $product_specification = $product->productAttachment->where('name', 'dimension')->first();
            if($product_specification){
                $product_specification->update([
                    'file_path' =>  $path,
                ]);
            }
            else{
                $product->productAttachment()->create([
                    'file_path' => $path,
                    'name' => 'dimension',
                    'product_id' => $product->id,
                ]);
            }
        }
        return redirect()->route('seller.products.show',$product->id)
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


    public function attributeajaxretrive(Request $request,$catid)
    {

        $getval = $request->newval;
        $returnDIV = "";

        $categoryAttributes = ProductCategoryAttribute::where('category_id',$catid)->get();


        if(!$categoryAttributes->isEmpty())
        {
            $returnDIV=$returnDIV.'<div class="form-group row"><div class="col-sm-12">Recommended Attribute </div></div>';
            foreach($categoryAttributes as $attribute){
                $returnDIV=$returnDIV.'<div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>'.$attribute->Attributes->name.'</strong></label>
                            <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="attr_'.$attribute->Attributes->id.'" type="'.$attribute->Attributes->type.'" class="form-control"
                                    name="attr['.$attribute->Attributes->id.']" />
                                </div>
                                    <div class="col-sm-6">';
                                       if (sizeof($attribute->Attributes->attributemeasurement) > 0){
                                           $returnDIV=$returnDIV.'<select name="unit['.$attribute->Attributes->id.']" class="form-control select2" id="unit_'.$attribute->Attributes->id.'">';
                                           foreach($attribute->Attributes->attributemeasurement as $measurement){
                                               $returnDIV=$returnDIV.'<option value="'.$measurement->id.'">  '.$measurement->name.' </option>';
                                           }
                                           $returnDIV=$returnDIV.' </select>';

                                       }
                $returnDIV=$returnDIV.'</div></div></div></div>';

            }
            return $returnDIV ;
        }else {
            return "" ;
        }
    }

    public function importproducts()
    {
        $categories = ProductCategory::orderBy('name')->get();
        // return view('seller.products.productimport',compact('categories'));
        return view('user.sales.products.importproducts',compact('categories'));

    }

    public function openPDF() {
        try {
            if(!Auth::user()) {
                return redirect()->route('login');
            }

            $path = Request::input('path');
            $pageFrom = Request::input('from', 1);
            $pageTo = Request::input('to', $pageFrom);

            $pdi = new Fpdi();
            $fileName = str_replace("storage/", "", $path);
            $file = Storage::disk('public')->path($fileName);

            if(!$file) {
                throw new Exception("Invalid file path, make sure it is from valid source, contact customer service for more information.");
            }

            $totalPage = $pdi->setSourceFile($file);

            if($totalPage >= $pageTo) {
                for($page = $pageFrom; $page <= $pageTo; $page++) {
                    $pdi->AddPage();
                    $targetPage = $pdi->ImportPage($page);
                    $pdi->UseTemplate($targetPage);
                }

                $response = response($pdi->Output('s'));
                $response->header('Content-Type', 'application/pdf');
                $response->header('Content-Disposition', 'inline; filename="' . $fileName . '"');
                $response->header('Cache-Control:', 'private, max-age=0, must-revalidate');

                return $response;
            } else {
                return redirect()->back()->with(["message" => "The pdf don have page " . $pageTo . "."]);
            }
        } catch(CrossReferenceException $ex) {
            return redirect()->back()->with(["message" => "This pdf file is unsopported version, contact customer serevice for more information."]);
        } catch(Exception $ex) {
            return redirect()->back()->with(["message" => $ex->getMessage()]);
        }
    }

    public function ajaxdelatt(Request $request,$id)
    {

        $getval = $request->newval;
        $file_attached = ProductAttachment::findOrFail($id);
        $file_path = storage_path("app/public/".$file_attached->file_path);
        if (File::exists($file_path)) {
            unlink($file_path);
        }
        $run_q = ProductAttachment::findOrFail($id)->delete();

        if($run_q)
        {
            return "<div class='well custom-well'> Attachment $getval deleted succesfully !</div>" ;
        }else {

            return "<div class='well custom-well'>Error In Deleting the Attachment !</div>" ;
        }
    }

    public function ajaxdelimg(Request $request,$id)
    {

        $getval = $request->newval;

        $image = ProductImage::findOrFail($id);

        $image_path = storage_path("app/public/".$image->path);
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        $run_q = ProductImage::findOrFail($id)->delete();

        if($run_q)
        {
            return "<div class='well custom-well'> Image $getval deleted succesfully !</div>" ;
        }else {

            return "<div class='well custom-well'>Error In Deleting the Image !</div>" ;
        }
    }


    public function getproducts(Request $request)
    {

        $user = Auth::getUser();
        $company = $user->company;

        if ($request->ajax()) {
            $data = DB::table('products')
                ->select('products.id','products.name','product_categories.name as category_name','brands.name as brand_name' )
                ->join('product_categories','products.category_id','=','product_categories.id')
                ->join('brands','products.brand_id','=','brands.id')
                ->where('products.company_id',$company->id)
                ->whereNull('products.deleted_at');
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="btn  btn-xs btn-info" href="'.route('seller.products.show',$row->id).'">Show</a>
                                            <a class="btn  btn-xs btn-primary" href="'. route('seller.products.edit',$row->id).'">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteproduct'.$row->id.'">Delete</button>
                                            <div id="deleteproduct'.$row->id.'" class="delete-modal modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="delete-icon"></div>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                            <p>Do you really want to delete this product? This process cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="'.route('seller.products.destroy',$row->id).'" class="pull-right">
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
