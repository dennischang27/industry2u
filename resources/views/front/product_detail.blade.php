@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Products') }}</title>
@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h3>{{$product->name}}</h3>
                    </div>
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
                        <li class="breadcrumb-item"><a href="{{route("public.products")}}" itemprop="item" title="Home">Products
                            </a></li>
                        <li class="breadcrumb-item active">{{$product->name}}</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box text-center">
                            <img id="product_img"  src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" alt="{{ $product->name }}">
                        </div>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                            @if(@file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                <div class="item">
                                    <a href="#" class="product_gallery_item active " data-image="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)}}" >
                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)}}" />
                                    </a>
                                </div>
                            @endif
                            @if(@file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)))
                                <div class="item">
                                    <a href="#" class="product_gallery_item" data-image="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)}}" >
                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)}}" />
                                    </a>
                                </div>
                            @endif
                            @if(@file_get_contents(asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
                                <div class="item">
                                    <a href="#" class="product_gallery_item" data-image="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path)}}" >
                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image2')->path)}}" />
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title">{{ $product->name }}</h4>
                            <div class="clearfix"></div>
                            <hr />
                            <div class="pr_desc">
                                <p>By: <strong>{{ $product->company->name }}</strong></p>
                                <p>{{ $product->company->city }}, {{ $product->company->state->name }}</p>
                            </div>
                            <ul class="product-meta">
                                <li>{{ __('Series No') }}: <strong>{{ $product->series_no }}</strong></li>
                                <li>{{ __('Category') }}:
                                    @if($product->category->parentCategory)
                                        <strong>{{ $product->category->parentCategory->name }}</strong> >
                                    @endif
                                    <strong>{{ $product->category->name }}</strong>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attachment-tab" data-toggle="tab" href="#attachment" role="tab" aria-controls="attachment" aria-selected="true">{{ __('Attachment') }}</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">{{ __('Reviews') }}</a>
                                </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div  class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {{$product->description}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <h5 class="header-title">Product Attributes</h5>
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
                            </div>
                            <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
                                <div  class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path)))
                                            <div class="col-sm-3">
                                                <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                <br>
                                                <span>Specification</span>
                                            </div>
                                        @endif
                                        @if($file = @file_get_contents(asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path)))
                                            <div class="col-sm-3">
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                <br>
                                                <span>Dimension</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div id="app">
                                    Review
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
