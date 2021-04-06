@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Center</b>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                Home
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Products Managenent</li>
                        <li class="breadcrumb-item active">My Products</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        .error {
            color: red;
        }
        .select2-selection__rendered {
            line-height: 37px !important;
        }
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        .select2-container  {
            margin-bottom: 15px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .img-wrap {
            width:100px;
            height:100px;
            border-radius: 10px;
            background: #fff;
            align-items: center;
            justify-content: center;
            border: 2px dashed #c2cdda;
            position:relative;
        }

        .img-wrap img {
            max-width:100%;
            max-height:100%;
        }
        .img-wrap {
            position: relative;
            display: inline-block;

            font-size: 0;
        }
        .img-wrap .closes {
            position: absolute;
            top: 5px;
            right: 8px;
            z-index: 100;
            background-color: #FFF;
            padding: 4px 3px;

            color: #ab1919;
            font-weight: bold;
            cursor: pointer;

            text-align: center;
            font-size: 16px;
            line-height: 10px;
            border-radius: 50%;
            border:1px solid #9f2840;
        }
        .img-wrap:hover .closes {
            opacity: 1;
        }
    </style>

@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Edit Product</h3>
                            </div>

                            <div class="card-body">

                                <form id="product_form" action="{{ route('seller.products.update', $product) }}" class="form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <h4 class="header-title">Product Information</h4>
                                            <br />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label"><strong>Product Name:</strong><small class="text-danger">*</small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" required  value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                        placeholder="Enter Product Name"
                                                        title="Please Enter Product Name">
                                                    <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug"
                                                        value="{{ $product->slug }}">
                                                </div>
                                                <div class="errorTxt"></div>
                                                @error('name')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="series_no" class="col-sm-3 col-form-label"><strong>Product Series No:</strong><small class="text-danger">*</small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" required class="form-control @error('series_no') is-invalid @enderror"
                                                        id="series_no" name="series_no"  placeholder="Enter Product Series No" value="{{ $product->series_no }}"
                                                        title="Please Enter Product Code">
                                                </div>
                                                @error('series_no')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="sku" class="col-sm-3 col-form-label"><strong>SKU:</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"  class="form-control"
                                                        id="sku" name="sku"  placeholder="Enter Product SKU" value="{{ $product->sku }}"
                                                        title="Please Enter Product SKU">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="description" class="col-sm-3 col-form-label"><strong>Product Description:</strong><small class="text-danger">*</small></label>
                                                <div class="col-sm-9">
                
                                                    <textarea class="form-control" style="height:150px" name="description" placeholder="Enter product description" title="Please enter product description" required>{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="brand_id" class="col-sm-3 col-form-label"><strong>Brand:</strong></label>
                                                <div class="col-sm-5">
                                                    <select title="Please select brand" required name="brand_id"
                                                            class="@error('brand_id') is-invalid @enderror form-control select2 have-other" id="brand_id" data-target="#brand_name">
                                                        <option value="">Select brand</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}"  {{$brand->id==$product->brand_id?'selected' : ''}}/> {{ $brand->name }} </option>
                                                        @endforeach
                                                        <option {{ old('brand_id') == 'Other' ? 'selected' : '' }} value="Other">Other Brand</option>
                                                    </select>
                                                    <div class="errorTxt"></div>
                                                    @error('brand_id')
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4" id="BrandDivText" style="display:{{ ($bShow = old('brand_id') == 'Other') ? 'block' : 'none' }};">
                                                    <input id="brand_name" name="brand_name" {{ $bShow ? 'required' : 'disabled' }} value="{{ old('brand_name') }}" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Brand Name" />
                
                                                    @error('brand_name')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-3 col-form-label"><strong>Category:</strong><small class="text-danger">*</small></label>
                                                <div class="col-sm-6" id="CatDiv" >
                                                    <select id="category_id" name="category_id" class="form-control select2" required title="Please select product category">
                                                        <option disabled value="">Select Category</option>
                                                        @foreach($categories->where('parent_id', null) as $category)
                
                                                            <optgroup label="{{ $category->name }}">
                                                                @if($category->subCategories)
                                                                    @foreach($category->subCategories as $subcategory)
                                                                        <option value="{{ $subcategory->id }}" {{  ($subcategory->id == $product->category_id) ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                
                                            </div>
                
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <hr>
                                            <h4 class="header-title">Sales Information</h4>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-3 col-form-label">
                                                    <strong>List Price:</strong>
                                                    <p style="font-size:12px;">(The list price is for supplier internal reference and only used in generating quotations and invoices)</p>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" required class="form-control @error('price') is-invalid @enderror"
                                                        id="price" name="price"  step="0.01" data-number-to-fixed="2" placeholder="Enter Product Price" value="{{$product->price}}"
                                                        title="Please Enter Valid Product Price">
                                                </div>
                                                @error('price')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <hr>
                                            <h4 class="header-title">Media Information</h4>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><strong>{{ __('Product images') }}:</strong></label>
                                                <div class="col-sm-3">
                                                    @if(isset($product->productImage->firstWhere('name', 'image_thumbnail')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                                        <div class="img-wrap">
                                                            <a href="#deleteimg{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}" data-toggle="modal" class="closes">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <!--span  class="img_click closes" title="Delete">&times;</span-->
                                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" width="100" height="100">
                                                        </div>
                                                        <!-- Modal for Delete-->
                                                        <div id="deleteimg{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}" class="delete-modal modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <div class="delete-icon"></div>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div class="display-none" id="resultdeleteimg{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}">
                                                                        </div>
                                                                        <input id="getDeleteValue{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="getDeleteValue{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}" value="{{$product->productImage->firstWhere('name', 'image_thumbnail')->name}}">
                                                                        <h4 class="modal-heading">Are You Sure ?</h4>
                                                                        <p>Do you really want to delete this Cover Photo? This process cannot be undone.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                
                                                                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                        <button type="button" onclick="submitdeleteimg('{{$product->productImage->firstWhere('name', 'image_thumbnail')->id}}')" class="btn btn-danger">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <span>Cover Photo</span>
                                                        @else
                                                            <div class="img-wrap">
                                                                <a href="#" data-toggle="modal" class="closes" id="img-thumb-remove" style="display: none">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                <img id="ImgtID" src="{{ asset('images/upload.jpg') }}" />
                                                            </div>
                                                            <input type="file" onchange="readimgthumbURL(this);" id="image_thumbnail"  name="image_thumbnail" value="{{old('image_thumbnail')}}" accept="image/png, image/jpeg"  class="form-control @error('image_thumbnail') is-invalid @enderror" required title="Please upload at least 1 image">
                                                            <span><small class="text-danger">*</small>Cover Photo</span>
                                                            @error('image_thumbnail')
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                </span>
                                                            <br>
                                                            @enderror
                                                        @endif
                
                                                </div>
                                                <div class="col-sm-3">
                
                                                    @if(isset($product->productImage->firstWhere('name', 'image1')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image1')->path)))
                                                        <div class="img-wrap">
                                                            <a href="#deleteimg{{$product->productImage->firstWhere('name', 'image1')->id}}" data-toggle="modal" class="closes">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <!--span  class="img_click closes" title="Delete">&times;</span-->
                                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path) }}" width="100" height="100">
                                                        </div>
                                                        <!-- Modal for Delete-->
                                                        <div id="deleteimg{{$product->productImage->firstWhere('name', 'image1')->id}}" class="delete-modal modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <div class="delete-icon"></div>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div class="display-none" id="resultdeleteimg{{$product->productImage->firstWhere('name', 'image1')->id}}">
                                                                        </div>
                                                                        <input id="getDeleteImgValue{{$product->productImage->firstWhere('name', 'image1')->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="getDeleteImgValue{{$product->productImage->firstWhere('name', 'image1')->id}}" value="{{$product->productImage->firstWhere('name', 'image1')->name}}">
                                                                        <h4 class="modal-heading">Are You Sure ?</h4>
                                                                        <p>Do you really want to delete Image 1? This process cannot be undone.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                
                
                                                                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                        <button type="button" onclick="submitdeleteimg('{{$product->productImage->firstWhere('name', 'image1')->id}}')" class="btn btn-danger">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <span>Image 1</span>
                                                    @else
                                                        <div class="img-wrap">
                                                            <a href="#" data-toggle="modal" class="closes" id="img1-remove" style="display: none">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <img id="Img1ID" src="{{ asset('images/upload.jpg') }}" />
                                                        </div>
                
                                                        <input type="file" onchange="readimg1URL(this);" id="image1"  name="image1" value="{{old('image1')}}" accept="image/png, image/jpeg" class="form-control @error('image1') is-invalid @enderror" >
                                                        <span>Image 1</span>
                                                        @error('image1')
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        <br>
                                                        @enderror
                                                    @endif
                
                                                </div>
                                                <div class="col-sm-3">
                                                    @if(isset($product->productImage->firstWhere('name', 'image2')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
                                                        <div class="img-wrap">
                                                            <a href="#deleteimg{{$product->productImage->firstWhere('name', 'image2')->id}}" data-toggle="modal" class="closes">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <!--span  class="img_click closes" title="Delete">&times;</span-->
                                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path) }}" width="100" height="100">
                                                        </div>
                                                        <!-- Modal for Delete-->
                                                        <div id="deleteimg{{$product->productImage->firstWhere('name', 'image2')->id}}" class="delete-modal modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <div class="delete-icon"></div>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div class="display-none" id="resultdeleteimg{{$product->productImage->firstWhere('name', 'image2')->id}}">
                                                                        </div>
                                                                        <input id="getDeleteImgValue{{$product->productImage->firstWhere('name', 'image2')->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="getDeleteImgValue{{$product->productImage->firstWhere('name', 'image2')->id}}" value="{{$product->productImage->firstWhere('name', 'image2')->name}}">
                                                                        <h4 class="modal-heading">Are You Sure ?</h4>
                                                                        <p>Do you really want to delete Image 2? This process cannot be undone.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                        <button type="button" onclick="submitdeleteimg('{{$product->productImage->firstWhere('name', 'image2')->id}}')" class="btn btn-danger">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <span>Image 2</span>
                                                    @else
                                                        <div class="img-wrap">
                                                            <a href="#" data-toggle="modal" class="closes" id="img2-remove" style="display: none">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <img id="Img2ID" src="{{ asset('images/upload.jpg') }}" />
                                                        </div>
                                                        <input type="file" onchange="readimg2URL(this);" id="image2" name="image2" value="{{old('image2')}}" accept="image/png, image/jpeg" class="form-control @error('image2') is-invalid @enderror">
                                                        <span>Image 2</span>
                                                        @error('image2')
                                                        <span class="invalid-feedback text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        <br>
                                                        @enderror
                
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <hr>
                                            <h4 class="header-title">Specification / Dimension Information</h4>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label for="specification" class="col-sm-3 col-form-label"><strong>{{ __('Attachment PDF') }}:</strong></label>
                                                <div class="col-sm-3">
                                                    <div class="row" style="min-height:140px;padding :10px;">
                                                    @if(isset($product->productAttachment->firstWhere('name', 'specification')->file_path))
                                                        <div class="img-wrap">
                                                            <a href="#deleteattch{{$product->productAttachment->firstWhere('name', 'specification')->id}}" data-toggle="modal" class="closes">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <!--span  class="img_click closes" title="Delete">&times;</span-->
                                                            <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                        </div>
                                                        <!-- Modal for Delete-->
                                                        <div id="deleteattch{{$product->productAttachment->firstWhere('name', 'specification')->id}}" class="delete-modal modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <div class="delete-icon"></div>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div class="display-none" id="resultdeleteatt{{$product->productAttachment->firstWhere('name', 'specification')->id}}">
                                                                        </div>
                                                                        <input id="getDeleteAttValue{{$product->productAttachment->firstWhere('name', 'specification')->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="getDeleteAttValue{{$product->productAttachment->firstWhere('name', 'specification')->id}}" value="{{$product->productAttachment->firstWhere('name', 'specification')->name}}">
                                                                        <h4 class="modal-heading">Are You Sure ?</h4>
                                                                        <p>Do you really want to delete this Specification file? This process cannot be undone.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                
                
                                                                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                        <button type="button" onclick="submitdeleteatt('{{$product->productAttachment->firstWhere('name', 'specification')->id}}')" class="btn btn-danger">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding :10px;">
                                                        <span>Specification</span>
                                                    </div>
                                                    @else
                                                        <div class="img-wrap">
                                                            <a href="#" data-toggle="modal" class="closes" id="spec-file-remove" style="display: none">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <img id="SpecID" src="{{ asset('images/upload.jpg') }}" />
                                                        </div>
                                                        <input type="file" onchange="readSpecURL(this);" value="{{old('specification')}}" id="specification"  name="specification"  accept="application/pdf, image/png, image/jpeg"  class="form-control @error('specification') is-invalid @enderror" >
                                                        <span>Specification</span>
                                                        @error('specification')
                                                        <span class="invalid-feedback text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="row" style="min-height:140px;padding :10px;">
                                                        @if(isset($product->productAttachment->firstWhere('name', 'dimension')->file_path))
                                                            <div class="img-wrap">
                                                                <a href="#deleteattch{{$product->productAttachment->firstWhere('name', 'dimension')->id}}" data-toggle="modal" class="closes">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                <!--span  class="img_click closes" title="Delete">&times;</span-->
                                                                <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                            </div>
                                                            <!-- Modal for Delete-->
                                                            <div id="deleteattch{{$product->productAttachment->firstWhere('name', 'dimension')->id}}" class="delete-modal modal fade" role="dialog">
                                                                <div class="modal-dialog modal-sm">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <div class="delete-icon"></div>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <div class="display-none" id="resultdeleteatt{{$product->productAttachment->firstWhere('name', 'dimension')->id}}">
                                                                            </div>
                                                                            <input id="getDeleteAttValue{{$product->productAttachment->firstWhere('name', 'dimension')->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="getDeleteAttValue{{$product->productAttachment->firstWhere('name', 'dimension')->id}}" value="{{$product->productAttachment->firstWhere('name', 'dimension')->name}}">
                                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                                            <p>Do you really want to delete this Dimension file? This process cannot be undone.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                
                
                                                                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                            <button type="button" onclick="submitdeleteatt('{{$product->productAttachment->firstWhere('name', 'dimension')->id}}')" class="btn btn-danger">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding :10px;">
                                                            <span>Dimension</span>
                                                        </div>
                                                        @else
                                                            <div class="img-wrap">
                                                                <a href="#" data-toggle="modal" class="closes" id="dimension-file-remove" style="display: none">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                <img id="DimID" src="{{ asset('images/upload.jpg') }}" />
                                                            </div>
                                                            <input type="file"  onchange="readDimensionURL(this);"  id="dimension"  name="dimension" value="{{old('dimension')}}" accept="application/pdf, image/png, image/jpeg" class="form-control @error('dimension') is-invalid @enderror" >
                                                            @error('dimension')
                                                                <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                            <span>Dimension</span>
                
                                                        </div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <hr>
                                            <h4 class="header-title">Attributes Information</h4>
                                        </div>
                                        <div  class="col-xs-12 col-sm-12 col-md-12">
                
                                            @foreach([0, 1, 2, 3, 4, 5, 6, 7, 8, 9] as $index)
                                                @php($sproduct = $product && $product->productAttribute ? $product->productAttribute->get($index) : null)
                                                @php($sproductattr = $sproduct ? $sproduct->attribute : null)
                                                @php($sproductattrmeasure = $sproduct ? $sproduct->attribute_measurement : null)
                                                @php($allattrmeasure = $sproductattr ? $sproductattr->attributemeasurement : null)
                
                                                <div class="form-group row attribute-group">
                                                    <label class="col-sm-3 col-form-label">
                                                        <select name="attributes[{{ $index }}]" class="form-control attribute-group-select">
                                                            <option {{ old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] ? '' : 'selected' }} value="">Select Attribute</option>
                                                            @foreach($attributes as $ag)
                                                                <option value="{{ $ag->id }}"
                                                                    {{ old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == $ag->id ? 'selected' :
                                                                    ($sproduct && $sproduct->attribute_id  == $ag->id ? 'selected' : '')}}>
                                                                    {{ $ag->name }}
                                                                </option>
                                                            @endforeach
                                                            <option {{ old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == 'Other' ? 'selected' : '' }} value="Other">Other Attribute</option>
                                                        </select>
                                                    </label>
                                                    <div class="col-sm-8 new-attribute-group" style="display: {{ ($aShow = old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == 'Other') ? 'block' : 'none' }};">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <!--div class="col-sm-2 form-check">
                                                                        <input id="attribute_type_{{ $index }}" name="attribute_type[{{ $index }}]" type="checkbox" value="1" {{ old('attribute_type') && isset(old('attribute_type')[$index]) ? 'checked' : '' }} class="form-check-input attribute-type" />
                                                                        <label for="attribute_type_{{ $index }}" class="form-check-label">
                                                                            Is Countable
                                                                        </label>
                                                                    </div-->
                                                                    <div class="col-sm-5">
                                                                        <input name="attribute_name[{{ $index }}]" type="text" value="{{ old('attribute_name') && isset(old('attribute_name')[$index]) ? old('attribute_name')[$index] : '' }}" class="form-control @error('attribute_type.' . $index) is-invalid @enderror" placeholder="Attribute Name" />
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <input class="form-control" type="text" name="attribute_value[{{ $index }}]" placeholder="Attribute Value" value="{{ old('attribute_value') && isset(old('attribute_value')[$index]) ? old('attribute_value')[$index] : '' }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 attribute-select {{ ($agsShow = old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == 'Other' && !isset(old('attribute_type')[$index])) ? ' offset-sm-4' : '' }}" style="display: {{ $agsShow ? 'block' :
                                            (old('attributes') && isset(old('attributes')[$index]) && ($ags = $attributes->find(old('attributes')[$index])) && !$ags->is_range ? 'block' :
                                            ($sproductattr ? ($sproductattr->is_range ? 'none' : 'block') :'none')) }};">
                                                        <input class="form-control" type="text" name="attribute_value[{{ $index }}]" placeholder="Attribute Value" value="{{ old('attribute_value') && isset(old('attribute_value')[$index]) ? old('attribute_value')[$index] : ($sproduct ? $sproduct->value : '')  }}" />
                                                    </div>
                                                    <div class="col-sm-8 attribute-range {{ ($agrShow = old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == 'Other' && isset(old('attribute_type')[$index])) ? ' offset-sm-4' : '' }}" style="display: {{ $agrShow ? 'block' :
                                            (old('attributes') && isset(old('attributes')[$index]) && ($agr = $attributes->find(old('attributes')[$index])) && $agr->is_range ? 'block' :($sproductattr ? ($sproductattr->is_range ? 'block' : 'none') :'none')) }};">
                                                        <div class="row">
                                                            <div class="col-md-3 com-sm-6">
                                                                <input class="form-control" type="number" require name="attribute_range_value[{{ $index }}]" placeholder="Attribute Value" value="{{ old('attribute_range_value') && isset(old('attribute_range_value')[$index]) ? old('attribute_range_value')[$index] : ($sproduct ? $sproduct->value : '')}}" />
                                                            </div>
                
                                                            <div class="col-md-4 com-sm-6">
                                                                <select name="attribute_unit[{{ $index }}]" class="form-control attribute-unit have-other" data-target="#attribute_unit_name_{{ $index }}">
                                                                    @if($allattrmeasure && $allattrmeasure->count() > 0)
                                                                        @foreach($allattrmeasure as $measurement)
                                                                            <option value="{{ $measurement->id }}" {{ old('attribute_unit') && isset(old('attribute_unit')[$index]) && old('attribute_unit')[$index] == $ag->id ? 'selected' :
                                                            ( $sproductattrmeasure && $sproductattrmeasure->name == $measurement->name ? 'selected' : '') }}>{{ $measurement->name }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="Other">Other measurement unit</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                
                                                            <div class="col-md-3 com-sm-6" style="display: {{ old('attribute_unit') && isset(old('attribute_unit')[$index]) && old('attribute_unit')[$index] == 'Other' ? 'block' : 'none' }};">
                                                                <input id="attribute_unit_name_{{ $index }}" class="form-control" type="text" name="attribute_unit_name[{{ $index }}]" placeholder="Unit Name" value="{{ old('attribute_unit_name') && isset(old('attribute_unit_name')[$index]) ? old('attribute_unit_name')[$index] : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script>
        var agOptions = {};
        {!! $attributes !!}.forEach(function(item) {
            agOptions[item.id] = item;
        });

        var agList = {!! $attributes->mapWithKeys(function ($item) {
            return [$item->id => $item];
        }) !!};

        var agPairs = {!! $attributes->pluck('attributemeasurement', 'id') !!};

        function getAttributeSelection(groupId) {
            aOptions = {
                "": "Please select attribute",
                "Other": "Other attribute"
            };

            if(groupId) {
                agPairs[groupId].forEach(function(item) {
                    aOptions[item.id] = item.name;
                });
            }

            return aOptions;
        }

        var deletefileurl = {!!json_encode( url('seller/file/') )!!};
        var deleteimgurl = {!!json_encode( url('seller/image/') )!!};
        function submitdeleteimg(id){

            var v = $('#getDeleteImgValue'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : deleteimgurl+'/'+id,
                success : function(data){
                    $('#resultdeleteimg'+id).html(data).slideDown(500);

                    window.setTimeout(function(){

                        location.reload();

                    }, 1500);

                }
            });

            setTimeout(function() {
                $('#resultdeleteimg'+id).slideUp(500);
            }, 2000);
        }

        function submitdeleteatt(id){

            var v = $('#getDeleteAttValue'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : deletefileurl+'/'+id,
                success : function(data){
                    $('#resultdeleteatt'+id).html(data).slideDown(500);

                    window.setTimeout(function(){

                        location.reload();

                    }, 1500);

                }
            });

            setTimeout(function() {
                $('#resultdeleteatt'+id).slideUp(500);
            }, 2000);
        }
        $(document).on('change', ".attribute-group-select", function() {
            var container = $(this).closest(".attribute-group");
            var rangeContainer = container.find(".attribute-range");
            var normalContainer = container.find(".attribute-select");


            if(this.value == 'Other') {

                var groupContainer = container.find(".new-attribute-group");
                groupContainer.show();

                //var groupType = groupContainer.find(".attribute-type");

                // if(groupType.is(':checked')) {
                //     showAttributeRangeInput(this, null);
                // } else {
                showAttributeNormalInput(this);
                // }
            } else {
                container.find(".new-attribute-group").hide();
                var ag = agOptions[this.value];
                if(ag) {
                    if(ag.is_range) {
                        showAttributeRangeInput(this, ag);
                    } else {
                        showAttributeNormalInput(this);
                    }

                    return;
                } else {
                    rangeContainer.find("input,select").attr("disabled", true);
                    normalContainer.find("input").attr("disabled", true);

                    rangeContainer.hide();
                    normalContainer.hide();
                }
            }
        });

        function showAttributeRangeInput(element, ag) {
            var rangeContainer = $(element).closest(".attribute-group").find(".attribute-range");
            var normalContainer = $(element).closest(".attribute-group").find(".attribute-select");

            rangeContainer.find("input,select").removeAttr("disabled");
            normalContainer.find("input").attr("disabled", true);

            var unit = $(element).closest(".attribute-group").find(".attribute-unit");
            unit.empty();

            if(ag) {
                if(ag.attributemeasurement && ag.attributemeasurement.length > 0) {
                    ag.attributemeasurement.forEach(function(item) {
                        var option = $("<option></option>");
                        option.val(item.id);
                        option.text(item.name);

                        unit.append(option);
                    });
                }
            }

            var option = $("<option></option>");
            option.val("Other");
            option.text("Other measurement unit");

            unit.append(option);
            unit.change();

            rangeContainer.show();
            normalContainer.hide();
        }

        function showAttributeNormalInput(element) {
            var rangeContainer = $(element).closest(".attribute-group").find(".attribute-range");
            var normalContainer = $(element).closest(".attribute-group").find(".attribute-select");

            rangeContainer.find("input,select").attr("disabled", true);
            rangeContainer.hide();
            if (element.value == 'Other'){
                normalContainer.find("input").attr("disabled", true);
                normalContainer.hide();
            }
            else{
                normalContainer.find("input").removeAttr("disabled");
                normalContainer.show();
            }
        }

        var subCategories = {!! $categories->where('parent_id', null)->values()->pluck('subCategories', 'id') !!};

        function getSubCategorySelection(categoryId) {
            subcatOptions = {
                "Other": "Other sub category"
            };
            if(categoryId && subCategories[categoryId]) {
                subCategories[categoryId].forEach(function(item) {
                    subcatOptions[item.id] = item.name;
                });
            }
            return subcatOptions;
        }

        $(".submit").click(function () {
            return true;
        });
        $('.select2').select2({
            allowClear: true,
            width: '100%'
        });
        $(document).ready(function() {


            var branddivtext = document.getElementById("BrandDivText");
            var brandvalue = $("#brand_id").val();
            if(brandvalue == 'Other') {

                branddivtext.style.display = "block";
            }
            else{

                branddivtext.style.display = "none";
            }
        });
        $(document).ready(function () {
            $("#name").keyup(function () {
                var Text = $(this).val();
                Text=Text.toLowerCase().replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
                $("#slug").val(Text);
            });
        });

        $(document).on('change', '.have-other', function() {
            var target = $(this.dataset.target);
            var container = target.parent();

            if(this.value == "Other") {
                target.attr("required", true);
                target.removeAttr("disabled");
                container.show();
            } else {
                target.removeAttr("required");
                target.attr("disabled", true);
                container.hide();
            }
        });
        jQuery(function ($) {
            var validator = $('#product_form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    code: {
                        required: true
                    }
                },
                messages: {},
                highlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                errorPlacement: function (error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        if(element.hasClass('select2') && element.next('.select2-container').length) {
                            error.insertAfter(element.next('.select2-container'));
                        }
                        else{
                            error.insertAfter(element);
                        }
                    }
                }
            });
        });
        function readimgthumbURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImgtID').attr('src', e.target.result);
                };
                $('#img-thumb-remove').show();
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img-thumb-remove").on("click", function(){
            $("#image_thumbnail").replaceWith( $("#image_thumbnail").val('').clone( true ) );
            $('#img-thumb-remove').hide();
            $("#ImgtID").attr('src', '{{ asset('images/upload.jpg') }}');
        });

        function readimg1URL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Img1ID').attr('src', e.target.result);
                };
                $('#img1-remove').show();
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img1-remove").on("click", function(){
            $("#image1").replaceWith( $("#image1").val('').clone( true ) );
            $('#img1-remove').hide();
            $("#Img1ID").attr('src', '{{ asset('images/upload.jpg') }}');
        });
        function readimg2URL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Img2ID').attr('src', e.target.result);
                };
                $('#img2-remove').show();
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img2-remove").on("click", function(){
            $("#image2").replaceWith( $("#image2").val('').clone( true ) );
            $('#img2-remove').hide();
            $("#Img2ID").attr('src', '{{ asset('images/upload.jpg') }}');
        });
        function readSpecURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                if((input.files[0].name.split('.').pop() =='pdf')||(input.files[0].name.split('.').pop() =='PDF')){
                    reader.onload = function(e) {
                        $('#SpecID').attr('src', '{{ asset('images/pdf-icon.png') }}');
                    };
                }
                else{
                    reader.onload = function(e) {
                        $('#SpecID').attr('src', e.target.result);
                    };
                }
                $('#spec-file-remove').show();
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#spec-file-remove").on("click", function(){
            $("#specification").replaceWith( $("#specification").val('').clone( true ) );
            $('#spec-file-remove').hide();
            $("#SpecID").attr('src', '{{ asset('images/upload.jpg') }}');
        });

        function readDimensionURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                if((input.files[0].name.split('.').pop() =='pdf')||(input.files[0].name.split('.').pop() =='PDF')){
                    reader.onload = function(e) {
                        $('#DimID').attr('src', '{{ asset('images/pdf-icon.png') }}');
                    };
                }
                else{
                    reader.onload = function(e) {
                        $('#DimID').attr('src', e.target.result);
                    };
                }
                $('#dimension-file-remove').show();
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#dimension-file-remove").on("click", function(){
            $("#dimension").replaceWith( $("#dimension").val('').clone( true ) );
            $('#dimension-file-remove').hide();
            $("#DimID").attr('src', '{{ asset('images/upload.jpg') }}');
        });
    </script>
@endsection

