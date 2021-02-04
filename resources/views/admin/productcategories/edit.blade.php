@extends('admin.layouts.app')
@section('style')
    <style>
        .custom-well {
            color: #fff;
            background: #3c8dbc;
            border: 1px solid #3c8dbc
        }
        .swatches-container .header {
            display:flex;
            flex-direction:row;
            font-weight:700;
            background-color: #3694d3;
            color:#fff
        }
        .swatches-container .header>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .header:before {
            content:"#";
            display:inline-block;
            width:50px;
            text-align:center;
            line-height:40px
        }
        .swatches-container .header .swatch-slug,
        .swatches-container .header .swatch-title,
        .swatches-container .header .swatch-min,
        .swatches-container .header .swatch-max,
        .swatches-container .header .swatch-value {
            flex:1
        }
        .swatches-container .header .action-item {
            width:80px
        }
        .swatches-container .swatches-list {
            float:left;
            list-style:none;
            margin:0 0 15px;
            padding:0;
            width:100%;
            counter-reset:swatches-list
        }
        .swatches-container .swatches-list li {
            padding-left:50px;
            display:flex;
            flex-direction:row;
            align-items:center;
            position:relative;
            counter-increment:swatches-list
        }
        .swatches-container .swatches-list li+li {
            margin-top:1px
        }
        .swatches-container .swatches-list li:nth-child(odd) {
            background-color:#f0f0f0
        }
        .swatches-container .swatches-list li:before {
            content:counter(swatches-list);
            width:50px;
            position:absolute;
            height:100%;
            top:0;
            left:0;
            cursor:move;
            background-color:#bbb;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center
        }
        .swatches-container .swatches-list li>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .swatches-list li .swatch-slug,
        .swatches-container .swatches-list li .swatch-min,
        .swatches-container .swatches-list li .swatch-max,
        .swatches-container .swatches-list li .swatch-title,
        .swatches-container .swatches-list li .swatch-value {
            flex:1
        }
        .swatches-container .swatches-list li .image-box-container img {
            border:1px solid #ccc;
            width:34px;
            height:34px
        }
        .swatches-container .swatches-list li .action-item {
            width:100px
        }
        .swatches-container .swatches-list .list-photo-hover-overlay {
            display:none
        }

    </style>

@endsection
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Product Category - {{ $productcategory->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 form-group ">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('admin.ecommerce.productcategories.index') }}"> Back</a>
                    </div>
                </div>
                <div class="card-body">
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
                    <form action="{{ route('admin.ecommerce.productcategories.update',$productcategory->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" id="name"  value="{{ $productcategory->name }}" class="form-control" placeholder="Name">

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Parent Category:</strong>
                                    <select id="parent_id" name="parent_id" class="form-control select2" title="Please select product category">
                                        <option value="">None</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($category->id == $productcategory->parent_id) ?'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Image:</strong>
                                    <div>
                                        @if(isset($productcategory->image))
                                            <img src="{{ asset('storage/categories/'.$productcategory->image) }}" width="100" height="100">
                                        @else
                                            <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                        @endif
                                    </div>
                                    <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                                    <small class="txt-desc">(Please Choose Brand Image To Replace)</small>
                                </div>
                            </div>
                            <input type="hidden" name="slug" id="slug" class="form-control" value="{{ $productcategory->slug }}">

                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 "  id ="attributemeasurementdiv">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div>
                        <h6>
                            <span><strong> Recommended Attribute List</strong></span>
                        </h6>
                    </div>
                    <div class="swatches-container">
                        <div class="header clearfix">
                            <div class="swatch-title">
                                Name
                            </div>
                            <div class="action-item">Action</div>
                        </div>
                        <ul class="swatches-list">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function(){
                var Text = $(this).val();
                Text=Text.toLowerCase().replace(/ /g,'_').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
                $("#slug").val(Text);
            });
        });
    </script>
@endsection
