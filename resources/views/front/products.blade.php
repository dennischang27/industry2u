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
        <form action="{{ URL::current() }}" method="GET">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <div class="product_header">
                                    <div class="product_header_left">
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm submit-form-on-change" name="sort-by" id="sort-by" >
                                                <option value="default_sorting" @if (request()->input('sort-by') == 'default_sorting') selected @endif>{{ __('Default') }}</option>
                                                <option value="date_asc" @if (request()->input('sort-by') == 'date_asc') selected @endif>{{ __('Oldest') }}</option>
                                                <option value="date_desc" @if (request()->input('sort-by') == 'date_desc') selected @endif>{{ __('Newest') }}</option>
                                                <option value="name_asc" @if (request()->input('sort-by') == 'name_asc') selected @endif>{{ __('Name') }}: {{ __('A-Z') }}</option>
                                                <option value="name_desc" @if (request()->input('sort-by') == 'name_desc') selected @endif>{{ __('Name') }}: {{ __('Z-A') }}</option>
                                            </select>
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
                                                    <span >{{ $product->company->city }}, {{ $product->company->state->name }}</span>
                                                </div>
                                                <div class="pr_desc">
                                                    <p>{{ $product->description }}</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mt-3 justify-content-center pagination_style1">
                                            {!! $products->appends(request()->query())->links() !!}
                                        </div>
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
                                <h5 class="widget_title">{{ __('Filters') }}</h5>
                                <ul class="widget_categories">

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

@endsection
