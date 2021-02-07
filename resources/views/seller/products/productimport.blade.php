@extends('seller.layouts.app')
@section('breadcrumbs')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><span>Import Products</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
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
    </style>

@endsection
@section('content')
    <div class="col-12  mt-4">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <label for="category_id" class="col-sm-3 col-form-label"><strong>Please select category to download the template:</strong><small class="text-danger">*</small></label>
                <div class="col-sm-6" id="CatDiv" >
                    <select id="category_id" name="category_id" class="form-control select2 select-category" required title="Please select product category">
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
            <div class="form-group row" id="divDownloadProduct">
                <a onclick="downloadTemplate();" class="btn btn-primary" id="downloadbtn" title="please select category"> Download Example For xls/csv File</a>
            </div>
        </div>

    </div>
    <div class="card shadow mb-4" id="divUploadProduct">
            <div class="card-body">
                <h4 class="header-title">Bulk product upload</h4>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><strong>Choose your xls/csv File:</strong></label>

                    </div>
                    <form action="{{route('seller.products.template.upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-4">
                                <input class="form-control " id="uploaded_file" accept=".xls, .xlsx" type="file" value="{{@old('uploaded_file')}}" name="uploaded_file" required="" autofocus="">
                            </div>
                            <div class="col-4">
                                <input class="btn btn-primary" type="submit" value="Upload">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card card-danger">
            <div class="card-header with-border">
                <div class="card-title">Instructions</div>
            </div>

            <div class="card-body">
                <p><b>Follow the instructions carefully before importing the file.</b></p>
                <p>The columns of the file should be in the following order.</p>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Column No</th>
                        <th>Column Name</th>
                        <th>Description</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><b>Category</b> (Required)</td>
                        <td>Name of category</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td><b>Subcategory</b> (Required)</td>
                        <td>Name of subcategory</td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td><b>Product Name</b> (Required)</td>
                        <td>Name of your product</td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td><b>Series No</b> (Required)</td>
                        <td>Series No of your product</td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td><b>Product Description</b> (Required)</td>
                        <td>Detail of your product</td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td><b>Product Brands</b> (Required)</td>
                        <td>Name of your brand</td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td><b>Price</b> (Required)</td>
                        <td>Your Product price <br/>[<b>Note:</b> Price must entered in this format eg. 50000 (No comma and character).<br>
                            The list price is for supplier internal reference and only used in generating quotations and invoices]</td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td><b>Product Image Name</b> (Optional)</td>
                        <td>Name for the product image, you can still doign single upload later.</td>
                    </tr>

                    <tr>
                        <td>9</td>
                        <td><b>Specification</b> (Optional)</td>
                        <td>PDF file name for specification, page from and page to</td>
                    </tr>

                    <tr>
                        <td>10</td>
                        <td><b>Dimension</b> (Optional)</td>
                        <td>PDF file name for Dimension,  page from and page to</td>
                    </tr>

                    <tr>
                        <td>11</td>
                        <td><b>Attribute</b> (Recommended)</td>
                        <td>Your Product Attributes  <br/>[<b>Note:</b> Attributes per category is recommended to fill up for better filter and product features.).]</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
    $('.select2').select2({
    allowClear: true,
    width: '100%'
    });
    $(document).ready(function() {
        $('#downloadbtn').tooltip();
    });
    function downloadTemplate(){
        var catvalue = $("#category_id").val();
        if(catvalue){
            window.location.href = "{{ route("seller.products.template.download") }}?cat="+catvalue;
        }

    }
    </script>
@endsection
