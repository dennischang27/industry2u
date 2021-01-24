@extends('seller.layouts.app')

@section('style')

    <style>
        .carousel-inner{
            border: 1px solid #aeadad;
        }
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        #productCarousel .carousel-indicators {
            position: static;
            margin-top: 20px;
            bottom: 0;
            margin: 0;
            left: 0;
            right: 0;
            width: auto;
        }


        #productCarousel .carousel-indicators>li {
            width: 100px;
            height: 120px;
            margin-top: 10px;
        }

        #productCarousel .carousel-indicators li img {
            display: block;
            opacity: 0.5;
            border: 1px solid #aeadad;
        }

        #productCarousel .carousel-indicators li.active img {
            opacity: 1
        }

        #productCarousel .carousel-indicators li:hover img {
            opacity: 0.75
        }

        .carousel-item img {
            width: 80%
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
                        <li><span>Show Product -{{ $product->name }} </span></li>
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
            <div class="card-header py-3">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('seller.products.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h3>Product -{{ $product->name }} </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 offset-sm-3 offset-md-3">
                            <div id="productCarousel" class="carousel slide" data-ride="carousel" align="center">
                                <!-- slides -->
                                <div class="carousel-inner">
                                    @if(isset($product->productImage->firstWhere('name', 'image_thumbnail')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" width="100" height="100">
                                        </div>
                                    @else
                                        <div class="carousel-item active">
                                            <img src="{{ asset('images/noimage.jpg') }}" width="100" height="100">
                                        </div>
                                    @endif
                                    @if(isset($product->productImage->firstWhere('name', 'image1')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image1')->path)))
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path) }}" width="100" height="100">
                                        </div>
                                    @endif
                                    @if(isset($product->productImage->firstWhere('name', 'image2')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path) }}" width="100" height="100">
                                        </div>
                                    @endif
                                </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                                <div class="form-group">
                                <ol class="carousel-indicators list-inline ">
                                    @if(isset($product->productImage->firstWhere('name', 'image_thumbnail')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                    <li class="list-inline-item active">
                                            <div style="float: left;">
                                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#productCarousel">
                                                <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" class="img-fluid">
                                            </a>
                                            </div>
                                            <div style="float: none; clear: both;"></div>
                                        </li>
                                    @endif
                                    @if(isset($product->productImage->firstWhere('name', 'image1')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image1l')->path)))
                                        <li class="list-inline-item">
                                            <div style="float: left;">
                                                <a id="carousel-selector-1" data-slide-to="1" data-target="#productCarousel">
                                                    <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path) }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                        @if(isset($product->productImage->firstWhere('name', 'image2')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
                                        <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="2" data-target="#productCarousel">
                                                 <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path) }}" class="img-fluid">
                                             </a>
                                         </li>
                                    @endif
                                </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <h4 class="header-title">Product Information</h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label"><strong>Product Name:</strong></label>
                                        <div class="col-sm-9">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="series_no" class="col-sm-3 col-form-label"><strong>Product Series No:</strong></label>
                                        <div class="col-sm-9">
                                            {{ $product->series_no }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label"><strong>Product Description:</strong></label>
                                        <div class="col-sm-9">
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="brand_id" class="col-sm-3 col-form-label"><strong>Brand:</strong></label>
                                        <div class="col-sm-9">
                                            {{ $product->brand->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="brand_id" class="col-sm-3 col-form-label"><strong>Category:</strong></label>
                                        <div class="col-sm-9">
                                            @if($product->category->parentCategory)
                                             {{ $product->category->parentCategory->name }} >
                                            @endif
                                             {{ $product->category->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <h4 class="header-title">Sales Information</h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><strong>Price:</strong></label>
                                        <div class="col-sm-9">
                                            {{ $product->price }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <h4 class="header-title">Product Specifications</h4>
                                </div>
                                <div  class="col-xs-12 col-sm-12 col-md-12">
                                    @foreach($product->productAttribute as $productAttribute)
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"><strong>{{ __($productAttribute->attribute->name) }}</strong></label>
                                            <div class="col-sm-9">
                                            {{ $productAttribute->value }}
                                            @if ($productAttribute->attribute_measurement)
                                                {{ $productAttribute->attribute_measurement->name }}
                                            @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <h4 class="header-title">Product Attachment</h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <label for="specification" class="col-sm-3 col-form-label"><strong>{{ __('Attachment PDF') }}:</strong></label>
                                        <div class="col-sm-3">
                                            <div class="row" style="min-height:140px;padding :10px;">

                                            @if(isset($product->productAttachment->firstWhere('name', 'specification')->file_path)&&file_exists(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))

                                                @if(getimagesize(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" width="100" height="100"></a>
                                                @else
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                @endif
                                            @else
                                                <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                            @endif
                                            </div>
                                            <span>Specification</span>
                                        </div>
                                        <div class="col-sm-3" >
                                            <div class="row" style="min-height:140px;padding :10px;">
                                            @if(isset($product->productAttachment->firstWhere('name', 'dimension')->file_path)&&file_exists(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                                @if(getimagesize(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" width="100" height="100"></a>
                                                @else
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                @endif
                                            @else
                                                <img src=" {{ asset('images/no-file.png') }}" width="100" height="100">
                                            @endif
                                            </div>
                                            <span>Dimension</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
