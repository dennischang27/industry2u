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
                        <h3></h3>
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
                        @empty($subcategory)

                            <li class="breadcrumb-item active">Products</li>

                        @else
                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <meta itemprop="position" content="1">
                                <a href="product/{{$subcategory->parentCategory->slug}}/{{$subcategory->parentCategory->id}}?categoryid={{$subcategory->parentCategory->id}}" itemprop="item" title="Home">
                                    {{$subcategory->parentCategory->name}}
                                    <meta itemprop="name" content="Home">
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{$subcategory->name}}</li>

                         @endif
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
                                            <input class="form-control" name="categoryid" value="{{ request()->input('categoryid') }}"  type="hidden">
                                        </div>
                                    </div>
                                    <div class="product_header_right">
                                        <div class="products_view">
                                            <a href="javascript:void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                            <!--a href="javascript:void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a-->
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
                                @if  ($recent_products)
                                    <div class="col col-12 col-md-12">
                                        <h4>Most Recent</h4>
                                    </div>
                                    @foreach($recent_products as $recent_product)
                                        <div class="col col-6 col-md-3">
                                            <div class="product">
                                                @if($recent_product->slug)
                                                    <a href="{{ 'productview/'.$recent_product->id.'/'.$recent_product->slug }}">
                                                @else
                                                    <a href="{{ 'productview/'.$recent_product->id.'/'.str_slug($recent_product->name)}}">
                                                @endif
                                                        <div class="product_img">
                                                            @if($recent_product->path)
                                                                @if(file_exists(public_path('storage/'.$recent_product->path)))
                                                                    <img src="{{ asset('storage/'.$recent_product->path) }}" alt="{{ $recent_product->name }}">
                                                                @else
                                                                    <img src="{{ asset('images/noimage.jpg') }}">
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('images/noimage.jpg') }}">
                                                            @endif
                                                        </div>
                                                    </a>
                                                    <div class="product_info">
                                                        <div class="product_name_wrap">
                                                            <span class='product_name' style="">
                                                                @if($recent_product->slug)
                                                                    <a href="{{ 'productview/'.$recent_product->id.'/'.$recent_product->slug }}">
                                                                @else
                                                                            <a href="{{ 'productview/'.$recent_product->id.'/'.str_slug($recent_product->name)}}">
                                                                @endif
                                                                        <strong>{{ str_limit($recent_product->name, 60) }}</strong>
                                                                   </a>
                                                            </span>
                                                            <span style="font-size: .75rem;line-height: .875rem;">{{ $recent_product->city }}, {{ $recent_product->state_name }}</span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col col-12 col-md-12">
                                       <hr>
                                    </div>
                                @endif
                                    @if  ($topview_products)
                                        <div class="col col-12 col-md-12">
                                            <h4>Top Views</h4>
                                        </div>
                                        @foreach($topview_products as $topview_product)
                                            <div class="col col-6 col-md-3">
                                                <div class="product">
                                                    @if($topview_product->slug)
                                                        <a href="{{ 'productview/'.$topview_product->id.'/'.$topview_product->slug }}">
                                                            @else
                                                                <a href="{{ 'productview/'.$topview_product->id.'/'.str_slug($topview_product->name)}}">
                                                                    @endif
                                                                    <div class="product_img">
                                                                        @if($topview_product->path)
                                                                            @if(file_exists(public_path('storage/'.$topview_product->path)))
                                                                                <img src="{{ asset('storage/'.$topview_product->path) }}" alt="{{ $topview_product->name }}">
                                                                            @else
                                                                                <img src="{{ asset('images/noimage.jpg') }}">
                                                                            @endif
                                                                        @else
                                                                            <img src="{{ asset('images/noimage.jpg') }}">
                                                                        @endif
                                                                    </div>
                                                                </a>
                                                                <div class="product_info">
                                                                    <div class="product_name_wrap">
                                                                        <span class='product_name' style="">
                                                                            @if($topview_product->slug)
                                                                                <a href="{{ 'productview/'.$topview_product->id.'/'.$topview_product->slug }}">
                                                                            @else
                                                                                        <a href="{{ 'productview/'.$topview_product->id.'/'.str_slug($topview_product->name)}}">
                                                                            @endif
                                                                                    <strong>{{ str_limit($topview_product->name, 60) }}</strong>
                                                                               </a>
                                                                        </span>
                                                                        <span style="font-size: .75rem;line-height: .875rem;">{{ $topview_product->city }}, {{ $topview_product->state_name }}</span>
                                                                    </div>
                                                                </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col col-12 col-md-12">
                                            <hr>
                                        </div>
                                    @endif
                                @foreach($products as $product)
                                    <div class="col col-6 col-md-3">

                                        <div class="product">
                                            @if($product->slug)
                                                <a href="{{ 'productview/'.$product->id.'/'.$product->slug }}">
                                            @else
                                                <a href="{{ 'productview/'.$product->id.'/'.str_slug($product->name)}}">
                                            @endif
                                                <div class="product_img">
                                                    @if($product->path)
                                                        @if(file_exists(public_path('storage/'.$product->path)))
                                                            <img src="{{ asset('storage/'.$product->path) }}" alt="{{ $product->name }}">
                                                        @else
                                                            <img src="{{ asset('images/noimage.jpg') }}">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('images/noimage.jpg') }}">
                                                    @endif
                                                </div>
                                            </a>
                                            <div class="product_info">
                                                <div class="product_name_wrap">
                                                    <span class='product_name' style="">
                                                        @if($product->slug)
                                                            <a href="{{ 'productview/'.$product->id.'/'.$product->slug }}">
                                                        @else
                                                            <a href="{{ 'productview/'.$product->id.'/'.str_slug($product->name)}}">
                                                        @endif
                                                                <strong>{{ str_limit($product->name, 60) }}</strong>
                                                           </a>
                                                    </span>
                                                    <span style="font-size: .75rem;line-height: .875rem;">{{ $product->city }}, {{ $product->state_name }}</span>
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
                                                @empty($subcategory)
                                                    <a href="#childOpen{{$category->id}}" data-toggle="collapse" class="cat-page " aria-expanded="false">
                                                @else
                                                    <a href="#childOpen{{$category->id}}" data-toggle="collapse" class="cat-page {{ ($category->id ==$subcategory->parentCategory->id )? '' : 'collapsed' }}" aria-expanded="false">
                                                @endif
                                                    <i class="fa fa-camera-retro"></i>
                                                    <label class="cursor-pointer">
                                                        {{ $category->name }}
                                                    </label>
                                                </a>
                                                     @empty($subcategory)
                                                        <ul class="widget_subcategory collapse " id="childOpen{{$category->id}}" style="">

                                                    @else
                                                         <ul class="widget_subcategory collapse {{ ($category->id ==$subcategory->parentCategory->id )? 'show' : '' }}" id="childOpen{{$category->id}}" style="">

                                                    @endif
                                                        @foreach($category->subCategories as $subcat)
                                                        @if($subcat->Products->count()>0)
                                                            <li class="left-4 dropdown menu-item side-sub-list">
                                                                @empty($subcategory)
                                                                    <a class="" data-toggle="collapse" href="#collapsesubcat{{$subcat->id}}" aria-expanded="false" aria-controls="collapsesubcat{{$subcat->id}}">
                                                                @else
                                                                    <a class="{{ ($subcat->id ==$subcategory->id )? 'active' : '' }}" data-toggle="collapse" href="#collapsesubcat{{$subcat->id}}" aria-expanded="false" aria-controls="collapsesubcat{{$subcat->id}}">
                                                                @endif
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
            var search_params = new URLSearchParams();

            search_params.set('categoryid', catid);
            url.search = search_params.toString();

            var new_url = url.toString();
            location.href=new_url;

            $(".se-pre-con").fadeIn("slow");
        };
    </script>
@endsection
