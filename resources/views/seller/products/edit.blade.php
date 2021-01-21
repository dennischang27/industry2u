@extends('seller.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
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
    </style>

@endsection

@section('breadcrumbs')

    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><a href="{{ route('seller.products.index') }}">Products</a></li>
                        <li><span>Edit Product</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
@endsection
@section('content')
    <!-- Table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h3>Edit Product</h3>
                        </div>
                    </div>
                </div>
                <form id="product_form" action="{{ route('seller.products.update', $product) }}" class="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4 class="header-title">Product Information</h4>
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
                                <label for="main_category_id" class="col-sm-3 col-form-label"><strong>Category:</strong></label>
                                <div class="col-sm-3" id="CatDiv" >
                                    <select id="main_category_id" name="main_category_id" class="form-control select2" required title="Please select product category">
                                        <option disabled {{ old('main_category_id') ? '' : 'selected' }} value="">Select Main Category</option>
                                        @foreach($categories->where('parent_id', null) as $category)
                                            <option value="{{ $category->id }}" {{ ($category->id == $product->category->parentCategory->id) ?: ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                        <option {{ old('main_category_id') == 'Other' ? 'selected' : '' }} value="Other" value="Other">Other Category</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="CatDivText" style="display: {{ ($mcShow = old('main_category_id') == 'Other') ? 'block' : 'none' }};">
                                    <input id="main_category_name" name="main_category_name"  {{ $mcShow ? 'required' : 'disabled' }}  value="{{ old('main_category_name') }}" class="form-control @error('main_category_name') is-invalid @enderror" placeholder="Main Category Name" />
                                    @error('main_category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3" id="SubCatDiv" style="display:{{ ($mcShow = old('main_category_id') == 'Other') ? 'block' : 'none' }};">
                                    <select id="category_id" name="category_id" class="form-control select2 have-other" required  data-target="#category_name">
                                        <option disabled {{ old('category_id') ? '' : 'selected' }} value="">Select Sub Category</option>
                                        @foreach($categories->where('parent_id', 1) as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id')?'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3" id="SubCatDivText" style="display: {{ ($cShow = old('main_category_id') == 'Other' || old('category_id') == 'Other') ? 'block' : 'none' }};">
                                    <input id="category_name" name="category_name" {{ $cShow ? 'required' : 'disabled' }} value="{{ old('category_name') }}" class="form-control @error('category_name') is-invalid @enderror" placeholder="Sub Category Name" />

                                    @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <h4 class="header-title">Sales Information</h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label"><strong>List Price:</strong>
                                    <br>(Only use in quotation and hidden from viewing)</label>
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
                                        @if($image = @file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" width="100" height="100">
                                        @else
                                            <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                        @endif
                                    <input type="file" name="image_thumbnail" value="{{old('image_thumbnail')}}" accept="image/png, image/jpeg"  class="form-control @error('image_thumbnail') is-invalid @enderror" title="Please upload at least 1 image">
                                    <span>Cover Photo</span>
                                    @error('image_thumbnail')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    <br>
                                    @enderror
                                </div>
                                <div class="col-sm-3">

                                    @if($image = @file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)))
                                        <div class="image-area">
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path) }}" width="100" height="100">
                                            <!--a class="remove-image" href="#" style="display: inline;">&#215;</a-->
                                        </div>
                                    @else
                                        <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                    @endif
                                    <input type="file" name="image1" value="{{old('image1')}}" accept="image/png, image/jpeg" class="form-control @error('image1') is-invalid @enderror" >
                                    <span>Image 1</span>
                                    @error('image1')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    @if($image = @file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
                                        <div class="image-area">
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path) }}" width="100" height="100">
                                            <!--a class="remove-image" href="#" style="display: inline;">&#215;</a-->
                                        </div>
                                    @else
                                        <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                    @endif
                                    <input type="file" name="image2" value="{{old('image2')}}" accept="image/png, image/jpeg" class="form-control @error('image2') is-invalid @enderror">
                                    <span>Image 2</span>
                                    @error('image2')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    <br>
                                    @enderror
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
                                    @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))
                                        <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                    @else
                                        <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                    @endif
                                    <br>
                                    <input type="file" value="{{old('specification')}}" name="specification"  accept="application/pdf"  class="form-control @error('specification') is-invalid @enderror" >
                                    <span>Specification</span>
                                    @error('specification')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                        <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                    @else
                                        <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                    @endif
                                    <input type="file" name="dimension" value="{{old('dimension')}}" accept="application/pdf" class="form-control @error('dimension') is-invalid @enderror" >
                                    @error('dimension')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    <span>Dimension</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <h4 class="header-title">Attributes Information</h4>
                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-12">
                            @foreach($attributes as $attribute)
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><strong>{{ __($attribute->name) }}</strong></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                @if(isset($productAttributes[$attribute->id]))
                                                <input id="attr_{{ $attribute->id }}" type="number"
                                                       class="form-control @error('attr.' .$attribute->id) is-invalid @enderror"
                                                       value="{{ $productAttributes[$attribute->id]->value }}" name="attr[{{ $attribute->id }}]" />
                                                @else
                                                    <input id="attr_{{ $attribute->id }}" type="{{($attribute->type)? $attribute->type : 'text'}}"
                                                           class="form-control @error('attr.' .$attribute->id) is-invalid @enderror"
                                                           value="{{ old('attr') ? old('attr')[$attribute->id] : null }}" name="attr[{{ $attribute->id }}]" />
                                                @endif

                                                @error('attr.' . $attribute->id)
                                                 <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                @if (sizeof($attribute->attributemeasurement) > 0)
                                                    <select name="unit[{{ $attribute->id }}]"
                                                            class="@error('unit.'.$attribute->id) is-invalid @enderror form-control  select2" id="unit_{{ $attribute->id }}">
                                                        @foreach($attribute->attributemeasurement as $measurement)
                                                            @if(isset($productAttributes[$attribute->id]))
                                                                <option value="{{ $measurement->id }}"  {{ $measurement->id == $productAttributes[$attribute->id]->attribute_measurement_id ? 'selected' : ''}}/>  {{ $measurement->name }} </option>
                                                            @else
                                                                <option value="{{ $measurement->id }}" />  {{ $measurement->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @endif
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
@endsection

@section('script')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script>
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

            var subcatdiv = document.getElementById("SubCatDiv");
            var subcatdivtext = document.getElementById("SubCatDivText");
            var catdivtext = document.getElementById("CatDivText");
            var branddivtext = document.getElementById("BrandDivText");
            var subcat = $("#category_id");
            subcat.empty();
            var value = $("#main_category_id").val();
            var brandvalue = $("#brand_id").val();
            var list = getSubCategorySelection(value);
            if(value == 'Other') {
                $("#main_category_name").attr("required", true);
                $("#main_category_name").parent().show();
                $("#main_category_name").removeAttr('disabled');

                subcat.removeAttr('required');
                subcat.parent().hide();
                subcat.attr('disabled', true);

                $("#category_name").attr("required", true);
                $("#category_name").parent().show();
                $("#category_name").removeAttr('disabled');

                subcatdiv.style.display = "none";
                catdivtext.style.display = "block";
                subcatdivtext.style.display = "block";
            }
            else{
                if(value){
                if (Object.keys(list).length > 1) {

                    catdivtext.style.display = "none";
                    subcatdiv.style.display = "block";
                    subcatdivtext.style.display = "none";

                    subcatdiv.style.display = "block";
                    $.each(list, function (id, name) {
                        var option = $("<option></option>");
                        option.val(id);
                        option.text(name);

                        subcat.append(option);
                    });
                } else {
                    catdivtext.style.display = "none";
                    subcatdiv.style.display = "block";
                    subcatdivtext.style.display = "block";
                    $.each(list, function (id, name) {
                        var option = $("<option></option>");
                        option.val(id);
                        option.text(name);

                        subcat.append(option);
                    });
                    $("#category_name").attr("required", true);
                    $("#category_name").parent().show();
                    $("#category_name").removeAttr('disabled');
                }
                }
            }
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
        $('#main_category_id').on('change', function () {

            var subcatdiv = document.getElementById("SubCatDiv");
            var subcatdivtext = document.getElementById("SubCatDivText");
            var catdivtext = document.getElementById("CatDivText");
            var subcat = $("#category_id");
            subcat.empty();
            var value = $(this).val();
            if(value == 'Other') {
                $("#main_category_name").attr("required", true);
                $("#main_category_name").parent().show();
                $("#main_category_name").removeAttr('disabled');

                subcat.removeAttr('required');
                subcat.parent().hide();
                subcat.attr('disabled', true);

                $("#category_name").attr("required", true);
                $("#category_name").parent().show();
                $("#category_name").removeAttr('disabled');

                subcatdiv.style.display = "none";
                catdivtext.style.display = "block";
                subcatdivtext.style.display = "block";

            }else {
                $("#main_category_name").removeAttr("required");
                $("#main_category_name").parent().hide();
                $("#main_category_name").attr('disabled', true);

                subcat.attr('required', true);
                subcat.parent().show();
                subcat.removeAttr('disabled');
                var list = getSubCategorySelection(value);

                if (Object.keys(list).length > 1) {

                    catdivtext.style.display = "none";
                    subcatdiv.style.display = "block";
                    subcatdivtext.style.display = "none";

                    subcatdiv.style.display = "block";
                    $.each(list, function (id, name) {
                        var option = $("<option></option>");
                        option.val(id);
                        option.text(name);

                        subcat.append(option);
                    });
                } else {
                    catdivtext.style.display = "none";
                    subcatdiv.style.display = "block";
                    subcatdivtext.style.display = "block";
                    $.each(list, function (id, name) {
                        var option = $("<option></option>");
                        option.val(id);
                        option.text(name);

                        subcat.append(option);
                    });
                    $("#category_name").attr("required", true);
                    $("#category_name").parent().show();
                    $("#category_name").removeAttr('disabled');
                }
            }

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
    </script>
@endsection
