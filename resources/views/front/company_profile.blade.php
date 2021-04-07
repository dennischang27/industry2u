@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' COMPANY PROFILE') }}</title>
@endsection
<!-- @section('style')
<style>
    .product_name h2 {
    line-height: 2.5ex;
    height: 5ex;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
@endsection -->
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>COMPANY PROFILE</h1>
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
                        <li class="breadcrumb-item active">COMPANY PROFILE</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="section">
    <div class="container">
        <div class="card"> 
        <div class="p-2 mb-2 bg-dark text-white-100">
        @if($company)
        <label><strong>SUPPLIER: {{ $company->name }}</strong></label></div>
            <div class="card-header">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" style="margin: auto;">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group ">
                                <div class="profile-img">
                                    @if(isset($company->logo))
                                        <img src="{{ asset('storage/'.$company->logo) }}" width="230" height="200">
                                    @else
                                        <img src=" {{ asset('images/noimage.jpg') }}" width="230" height="200">
                                    @endif
                                </div>
                                </div>
                            </div>
                            <div class="col-8">
                            <label>COMPANY INFORMATION</label>
                            <hr>
                                <label><strong>ADDRESS:</strong></label>
                                <p><label>{{ $company->street }},{{ $company->postal_code }}
                                    {{ $company->state->name }}</label></p>
                            </div>      
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endif
    </div> 
    <div class="section">
    <form id="ProductList" action="{{ URL::current() }}" method="GET">
        <div class="container">
            <div class="card">
                <div class="p-2 mb-2 bg-dark">
                    <label><strong>PRODUCT LISTING</strong></label></div>
                            <div class="card-header">
                                <div class="float-left">
                                    <div class="row">
                                        @if( count($categories)>0 )
                                            <div class="product-sorting">
                                                <label> &nbsp; Sort By</label>
                                                <div class="col">
                                                    <select class="form-control form-control-sm submit-form-on-change" name="sort">
                                                        <option value="All">{{ __('All') }}</option>
                                                        <option value="product_asc" @if (request()->input('sort')=='product_asc')) selected @endif>Name: A to Z</option>
                                                        <option value="product_desc"@if (request()->input('sort')=='product_desc')) selected @endif>Name: Z to A</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="categories-select">
                                                <label>&nbsp;Category</label>
                                                <div class="col">
                                                    <select class="form-control form-control-sm submit-form-on-change" name="subcat">
                                                            <option value="All">{{ __('All') }}</option>
                                                            @foreach ($categories as $category)
                                                                <option disabled value="">{!! $category->name !!} </option>
                                                                <option value="{{$category->subcat_id}}" @if (request()->input('subcat')==$category->subcat_id)) selected @endif >{!! $category->subcat_name !!}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div style="float:right">
                                    @if($subcat_selected != '')
                                        <h6 value="{{$subcat_selected->id}}" style="font-size: 13px";>{!! $subcat_selected->parentCategory->name !!} > {!! $subcat_selected->name !!}</h6>                            
                                    @endif
                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center">
                                    {!! $products->appends(request()->query())->links() !!}
                                            <!-- {!! $products->links() !!} -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($products->count() > 0)
                                    <div class="row row-cols-1 row-cols-md-5">
                                        @foreach ($products as $product)
                                            <div class="col" style="margin-bottom: 20px">
                                                <div class="card shadow-sm">
                                                    @if(isset($product->path))
                                                        <img src="{{ asset('storage/'.$product_images->path)}}" width="233" height="180">
                                                    @else
                                                        <img src="{{ asset('images/noimage.jpg') }}" width="233" height="180">
                                                    @endif    
                                                        <div class="card-body" style="">
                                                        <span class='product_name' style="">
                                                            <a href="{{ 'productview/'.$product->id.'/'.$product->slug }}"><strong>{{ str_limit($product->name, 33) }}</strong></a>
                                                        </span><br>
                                                        <div class="btn-group">
                                                            <a href="{{ url('productview/'.$product->id.'/'.$product->slug) }}" 
                                                            class="btn btn-sm btn-outline-primary btn-rounded">View</a>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                        @endforeach  
                                    </div>
                                @else
                                    <div class="col text-center">{{ __('No Products!') }}</div>
                                @endif
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">  
                                        <div class="col">
                                            {{-- Pagination --}}
                                            <div class="d-flex justify-content-center">
                                                {!! $products->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>   
                </div>
            </div>
        </div> 
    </div> 
    </form>
</div> 
@endsection
