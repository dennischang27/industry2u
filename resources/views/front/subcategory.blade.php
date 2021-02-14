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
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                {{$subcategory->parentCategory->name}}
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{$subcategory->name}}</li>
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
                                            <input name="categoryid" value="{{ request()->input('categoryid') }}" type="hidden">
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
                                                <option value="16" @if (request()->input('num') == 16) selected @endif>16</option>
                                                <option value="20" @if (request()->input('num') == 20) selected @endif>20</option>
                                                <option value="24" @if (request()->input('num') == 24) selected @endif>24</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row shop_container grid">
                            @if ($products->count() > 0)
                                @foreach($products as $product)
                                    <div class="col col-6 col-md-3">

                                        <div class="product">
                                            <div class="product_img">
                                                @if($product->productImage->firstWhere('name', 'image_thumbnail'))
                                                    @if(file_exists(public_path('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path)))
                                                        <a href="{{ URL::to('/').'/productview/'.$product->id.'/'.$product->slug }}">
                                                            <img src="{{ asset('storage/'.$product->productImage->firstWhere('name', 'image_thumbnail')->path) }}" alt="{{ $product->name }}">
                                                        </a>
                                                    @else
                                                        <img src="{{ asset('images/noimage.jpg') }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('images/noimage.jpg') }}">
                                                @endif
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_title"><a href="{{ URL::to('/').'/productview/'.$product->id.'/'.$product->slug }}">{{ $product->name }}</a></h6>
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
                                <ul class="widget_category">
                                    @foreach($categories as $index => $category)
                                        @if($category->subProducts->count()>0)
                                            <li class="dropdown menu-item">
                                                <a href="#childOpen{{$category->id}}" data-toggle="collapse" class="cat-page {{ ($category->id ==$subcategory->parentCategory->id )? '' : 'collapsed' }}" aria-expanded="false">
                                                    <i class="fa fa-camera-retro"></i>
                                                    <label class="cursor-pointer">
                                                        {{ $category->name }}
                                                    </label>
                                                </a>
                                                <ul class="widget_subcategory collapse {{ ($category->id ==$subcategory->parentCategory->id )? 'show' : '' }}" id="childOpen{{$category->id}}" style="">
                                                    @foreach($category->subCategories as $subcat)
                                                        @if($subcat->Products->count()>0)
                                                        <li class="left-4 dropdown menu-item side-sub-list">
                                                            <a class="{{ ($subcat->id ==$subcategory->id )? 'active' : '' }}" data-toggle="collapse" href="#collapsesubcat{{$subcat->id}}" aria-expanded="false" aria-controls="collapsesubcat{{$subcat->id}}">
                                                                <label class="cursor-pointer" onclick="categoryfilter({{ $subcat->id}})">
                                                                    {{trim($subcat->name)}}
                                                                </label>
                                                            </a>
                                                        </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
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

        function categoryfilter(catid) {
            var url = new URL( window.location.href);

            var query_string = url.search;
            var search_params = new URLSearchParams(query_string);

            search_params.set('categoryid', catid);
            url.search = search_params.toString();
            console.log(url.search);

            var new_url = url.toString();
            location.href=new_url;
        };
    </script>
@endsection
