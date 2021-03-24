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
                            @if(isset($product->productImage->firstWhere('name', 'image_thumbnail')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                            <img id="product_img"  src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/noimage.jpg') }}">
                            @endif
                        </div>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                            @if(isset($product->productImage->firstWhere('name', 'image_thumbnail')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                 <div class="item">
                                    <a href="#" class="product_gallery_item active " data-image="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)}}" >
                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)}}" />
                                    </a>
                                </div>
                            @endif
                                @if(isset($product->productImage->firstWhere('name', 'image1')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image1')->path)))
                                <div class="item">
                                    <a href="#" class="product_gallery_item" data-image="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)}}" >
                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image1')->path)}}" />
                                    </a>
                                </div>
                            @endif
                                @if(isset($product->productImage->firstWhere('name', 'image2')->path)&&file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image2')->path)))
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
                                <p>{{ __('Series No') }}: <strong>{{ $product->series_no }}</strong></p>

                                <p>{{ __('Brand') }}: <strong>{{ $product->brand->name }}</strong></p>
                                <p>{{ __('Category') }}:
                                    @if($product->category->parentCategory)
                                        <strong>{{ $product->category->parentCategory->name }}</strong> >
                                    @endif
                                    <strong>{{ $product->category->name }}</strong></p>
                                <p>Company: <strong>{{ $product->company->name }}</strong></p>
                                <p><strong>{{ $product->company->city }}, {{ $product->company->state->name }}</strong></p>
                            </div>
                            <div class="cart_extra">
                                <form class="add-to-cart-form" method="POST" action="{{ route("public.cart.add") }}">
                                    @csrf
                                    <input type="hidden" name="product_id" id="hidden-product-id" value="{{ $product->id }}">
                                    <input type="hidden" name="company_id" id="hidden-company-id" value="{{ $product->company_id }}">

                                    @if (auth('web')->check())

                                        @if (!auth('web')->user()->is_buyer )
                                         <div class="cart_btn">
                                             Please <a href="{{ route("addcompany") }}">submit company information</a> to request.
                                        </div>
                                        @else
                                            <div class="cart-product-quantity">
                                                <div class="quantity float-left">
                                                    <input type="button" value="-" class="minus">
                                                    <input type="text" name="qty" value="1" title="Qty" class="qty" size="4">
                                                    <input type="button" value="+" class="plus">
                                                </div> &nbsp;
                                                <div class="float-right number-items-available" style="display: none; line-height: 45px;"></div>
                                            </div>
                                            <br>
                                            <div class="cart_btn">
                                                <button class="btn btn-fill-out btn-addtocart" type="submit"><i class="icon-basket-loaded"></i> Add to wanted list</button>
                                            </div>
                                            <br>
                                            <div class="success-message text-success" style="display: none;">
                                                <span></span>
                                            </div>
                                            <div class="error-message text-danger" style="display: none;">
                                                <span></span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="cart_btn">
                                            Please <a href="{{ route("register") }}">register and submit company information</a> to request.
                                        </div>
                                    @endif

                                </form>
                            </div>

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
                                <!--li class="nav-item">
                                    <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">{{ __('Reviews') }}</a>
                                </li-->
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div  class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <span style="white-space: pre-wrap;">{{ $product->description }}</span>
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
                                        @if(isset($product->productAttachment->firstWhere('name', 'specification')->file_path))
                                            <div class="col-sm-3">
                                                <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'specification')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                <br>
                                                <span>Specification</span>
                                            </div>
                                        @endif
                                            @if(isset($product->productAttachment->firstWhere('name', 'dimension')->file_path))
                                            <div class="col-sm-3">
                                                    <a href="{{ asset('storage/'.$product->productAttachment->firstWhere('name', 'dimension')->file_path) }}" target="_blank"><img src=" {{ asset('images/pdf-icon.png') }}" width="100" height="100"></a>
                                                <br>
                                                <span>Dimension</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div id="app">
                                    Review
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
