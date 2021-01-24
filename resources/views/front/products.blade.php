@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Products') }}</title>
@endsection

@section('style')
<style>
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url({{ asset('images/Preloader_1.gif') }} ) center no-repeat #fff;
    }
</style>
@endsection
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h3>Products</h3>
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
                        <li class="breadcrumb-item active">Products</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="section">
        <form id="searchProduct" action="{{ URL::current() }}" method="GET">
            <input type="hidden" value="{{ request()->input('q') }}" name="q"  >
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <div class="product_header">
                                    <div class="product_header_left">
                                        <div class="input-group">
                                            <input class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Search Product..." required="" type="text">
                                            <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                                        </div>
                                    </div>
                                    <div class="product_header_right">
                                        <div class="products_view">
                                            <a href="javascript:void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                            <a href="javascript:void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                        </div>
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm submit-form-on-change" name="num">
                                                <option value="">{{ __('Showing') }}</option>
                                                <option value="9" @if (request()->input('num') == 9) selected @endif>9</option>
                                                <option value="12" @if (request()->input('num') == 12) selected @endif>12</option>
                                                <option value="18" @if (request()->input('num') == 18) selected @endif>18</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row shop_container grid">
                            @if ($products->count() > 0)
                                @foreach($products as $product)
                                    <div class="col-md-4 col-6">
                                        <div class="product">
                                            <div class="product_img">
                                                @if($product->productImage->firstWhere('name', 'image_thumbnail'))
                                                    <a href="{{ 'product/'.$product->id.'/'.$product->slug }}">
                                                        <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" alt="{{ $product->name }}">
                                                    </a>
                                                @else
                                                    <img src="{{ asset('images/noimage.jpg') }}">
                                                @endif

                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_title"><a href="{{ 'product/'.$product->id.'/'.$product->slug }}">{{ $product->name }}</a></h6>
                                                <div >
                                                    <span style="font-size: 12px;">{{ $product->company->city }}, {{ $product->company->state->name }}</span>
                                                </div>
                                                <div class="pr_desc">
                                                    <p>{{ $product->description }}</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                    <div class="col-12">
                                        <div class="justify-content-center ">
                                            {!! $products->appends(request()->query())->links() !!}
                                        </div>
                                    </div>
                            @else
                                <br>
                                <div class="col-12 text-center">{{ __('No products!') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                        <div class="sidebar">
                            <div class="widget">
                                <h5 class="widget_title">{{ __('Categories') }}</h5>
                                <ul class="widget_categories">
                                    @foreach($categories as $index => $category)
                                        @if($category->subProducts->count()>0)
                                        <li>
                                            <div class="custome-checkbox">
                                                <input class="form-check-input submit-form-on-change" type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" @if (in_array($category->id , request()->input('categories', []))) checked @endif>
                                                <label class="form-check-label" for="category-{{ $category->id }}">
                                                    <span>{{ $category->name }}
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <div class="se-pre-con"></div>
    <script>
        $(window).on('load', function(){
            $(".se-pre-con").fadeOut("slow");
        });
        $(document).ready(function() {
            var searchForm2Div = document.getElementById("serch_form2");
            searchForm2Div.style.display = "none";

            var searchFormDiv = document.getElementById("serch_form");
            searchFormDiv.style.display = "none";
        });
        $('#searchProduct').submit(function() {
            var pass = true;
            //some validations

            if(pass == false){
                return false;
            }
            $(".se-pre-con").fadeIn("slow");

            return true;
        });
    </script>
@endsection
