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
                                    <div class="row" style="min-height:140px;padding :10px;">
                                    @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))
                                        @if(getimagesize(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))
                                            <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" width="100" height="100"></a>
                                        @else
                                            <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                        @endif

                                    @else
                                        <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                    @endif
                                    </div>
                                    <div class="row"style="padding :10px;">
                                    <input type="file" value="{{old('specification')}}" name="specification"  accept="application/pdf, image/png, image/jpeg"  class="form-control @error('specification') is-invalid @enderror" >
                                    <span>Specification</span>
                                    @error('specification')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row" style="min-height:140px;padding :10px;">
                                        @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                            @if(getimagesize(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                                <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" width="100" height="100"></a>
                                            @else
                                            <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                            @endif
                                        @else
                                            <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                        @endif
                                    </div>
                                    <div class="row" style="padding :10px;">
                                    <input type="file" name="dimension" value="{{old('dimension')}}" accept="application/pdf, image/png, image/jpeg" class="form-control @error('dimension') is-invalid @enderror" >
                                    @error('dimension')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    <span>Dimension</span>
                                    </div>
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
                                                    <div class="col-sm-2 form-check">
                                                        <input id="attribute_type_{{ $index }}" name="attribute_type[{{ $index }}]" type="checkbox" value="1" {{ old('attribute_type') && isset(old('attribute_type')[$index]) ? 'checked' : '' }} class="form-check-input attribute-type" />
                                                        <label for="attribute_type_{{ $index }}" class="form-check-label">
                                                            Is Countable
                                                        </label>
                                                    </div>
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
