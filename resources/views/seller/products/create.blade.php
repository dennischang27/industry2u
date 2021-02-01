@extends('seller.layouts.app')
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
                        <li><span>Add New Product</span></li>
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
                            <h3>Add a New Product</h3>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="product_form" action="{{ route('seller.products.store') }}" class="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <h4 class="header-title">Product Information</h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label"><strong>Product Name:</strong><small class="text-danger">*</small></label>
                                <div class="col-sm-9">
                                    <input type="text" required  value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           placeholder="Enter Product Name"
                                           title="Please Enter Product Name">
                                    <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug"
                                           value="{{ old('slug') }}">
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
                                           id="series_no" name="series_no"  placeholder="Enter Product Series No" value="{{old('series_no')}}"
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
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Enter product description" title="Please enter product description" required>{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group row">
                                <label for="brand_id" class="col-sm-3 col-form-label"><strong>Brand:</strong><small class="text-danger">*</small></label>
                                <div class="col-sm-5">
                                    <select title="Please select brand" required name="brand_id"
                                            class="@error('brand_id') is-invalid @enderror form-control select2 have-other" id="brand_id" data-target="#brand_name" >
                                        <option value="">Select brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}"  {{ $brand->id == old('brand_id')?'selected' : ''}}/> {{ $brand->name }} </option>
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
                                <div class="col-sm-4"  id="BrandDivText" style="display: {{ ($bShow = old('brand_id') == 'Other') ? 'block' : 'none' }};">
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
                                        <option disabled {{ old('category_id') ? '' : 'selected' }} value="">Select Category</option>
                                        @foreach($categories->where('parent_id', null) as $category)

                                            <optgroup label="{{ $category->name }}">
                                            @if($category->subCategories)
                                                @foreach($category->subCategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == old('category_id')?'selected' : ''}}>{{ $subcategory->name }}</option>
                                                @endforeach
                                            @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

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
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                           id="price" name="price"  step="0.01" data-number-to-fixed="2" placeholder="Enter Product Price" value="{{old('price')}}"
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
                                <label for="category_id" class="col-sm-3 col-form-label"><strong>{{ __('Product images') }}:</strong></label>
                                <div class="col-sm-3">
                                    <input type="file" name="image_thumbnail" value="{{old('image_thumbnail')}}" accept="image/png, image/jpeg"  class="form-control @error('image_thumbnail') is-invalid @enderror" required title="Please upload at least 1 image">
                                    <span><small class="text-danger">*</small>Cover Photo</span>
                                    @error('image_thumbnail')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    <br>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
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
                                    <input type="file" value="{{old('specification')}}" name="specification"  accept="application/pdf, image/png, image/jpeg"  class="form-control @error('specification') is-invalid @enderror" >
                                    <span>Specification</span>
                                    @error('specification')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
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
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <h4 class="header-title">Attributes Information</h4>
                        </div>
                        <div  class="col-xs-12 col-sm-12 col-md-12">
                            @foreach([0, 1, 2, 3, 4, 5, 6, 7, 8, 9] as $index)
                                <div class="form-group row attribute-group">
                                    <label class="col-sm-3 col-form-label">
                                        <select name="attributes[{{ $index }}]" class="form-control attribute-group-select">
                                            <option  {{ old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] ? '' : 'selected' }} value="">Select Attribute</option>
                                            @foreach($attributes as $ag)
                                                <option value="{{ $ag->id }}"
                                                    {{ old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == $ag->id ? 'selected' :''}}>
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
							(old('attributes') && isset(old('attributes')[$index]) && ($ags = $attribute_group_list->find(old('attributes')[$index])) && !$ags->is_range ? 'block' :'none') }};">
                                        <input class="form-control" type="text" name="attribute_value[{{ $index }}]" placeholder="Attribute Value" value="{{ old('attribute_value') && isset(old('attribute_value')[$index]) ? old('attribute_value')[$index] : '' }}" />
                                    </div>
                                    <div class="col-sm-8 attribute-range {{ ($agrShow = old('attributes') && isset(old('attributes')[$index]) && old('attributes')[$index] == 'Other' && isset(old('attribute_type')[$index])) ? ' offset-sm-4' : '' }}" style="display: {{ $agrShow ? 'block' :
							(old('attributes') && isset(old('attributes')[$index]) && ($agr = $attribute_group_list->find(old('attributes')[$index])) && $agr->is_range ? 'block' :'none') }};">
                                        <div class="row">
                                            <div class="col-md-3 com-sm-6">
                                                <input class="form-control" type="number" require name="attribute_range_value[{{ $index }}]" placeholder="Attribute Value" value="{{ old('attribute_range_value') && isset(old('attribute_range_value')[$index]) ? old('attribute_range_value')[$index] : ''}}" />
                                            </div>

                                            <div class="col-md-4 com-sm-6">
                                                <select name="attribute_unit[{{ $index }}]" class="form-control attribute-unit have-other" data-target="#attribute_unit_name_{{ $index }}">
                                                        <option value="Other">Other measurement unit</option>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
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
            var branddivtext = document.getElementById("BrandDivText");
            var brandvalue = $("#brand_id").val();
            if(brandvalue == 'Other') {
                branddivtext.style.display = "block";
                branddivtext.attr("required", true);
            }
        });
        $(document).ready(function () {
            $("#name").keyup(function () {
                var Text = $(this).val();
                Text=Text.toLowerCase().replace(/ /g,'_').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
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
    </script>
@endsection
