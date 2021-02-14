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
                        <li class="breadcrumb-item active">Category: {{$category->name}}</li>
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
                    <div class="col-xs-12 col-12">
                        <div class="row">
                            <!--div class="col-xs-12 col-sm-1 product-imgwrap">
                                <img src="{{asset('storage/categories/'.$category->image)}}" title="{{$category->name}}">
                            </div-->
                            <div class="col-xs-12 col-sm-10 img-description">
                                <h3 class="category-name">{{$category->name}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12  mt-4">
                        <div class="row shop_container grid">
                            @if ($subcategories->count() > 0)
                                @foreach($subcategories as $subcategory)
                                    @if ($subcategory->products->count()>0)
                                    <div class="col col-6 col-md-6 mt-4">
                                        <div class="product">
                                            <div class="product_info">
                                                <h6 class="product_title"><a href="{{URL::to('/')}}/products?categoryid={{$subcategory->id}}">{{ $subcategory->name }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                            @else
                                <br>
                                <div class="col-12 text-center">{{ __('No Subcategory!') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')

@endsection
