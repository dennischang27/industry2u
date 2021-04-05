@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' COMPANY PROFILE') }}</title>
@endsection
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

                                    </div></hr>       
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endif
    </div> 
    <div class="section">
        <div class="container">
            <div class="card">
                <div class="p-2 mb-2 bg-dark">
                    <label><strong>PRODUCT LISTING</strong></label></div>
                            <div class="card-header">
                                <div class="float-left">
                                    <div class="row">
                                    <div class="dropdown">
                                        @if( count($categories)>0 )
                                        <label>&nbsp;Category  </label>
                                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select 
                                            </button>                        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @foreach ($categories as $category)
                                                            <option disabled value=""style="font-size: 13px";>{!! $category->name !!} </option>
                                                            <a class="dropdown-item" href='?subcat={{$category->subcat_id}}' option value="{{$category->subcat_id}}" style="font-size: 13px";>{!! $category->subcat_name !!}</a>
                                                        @endforeach
                                                </div>
                                                </div>
                                        @else
                                    </div>
                                        @endif
                                        <div class="row-5">
                                        @if( count($categories)>0 )
                                            <div class="product-sorting">
                                            <label> &nbsp; Sort By</label>
                                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select 
                                                </button>                        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <div class="col">
                                                        <a href="{{ URL::Current()}}" class="sort-font" style="font-size: 13px";>&nbsp;All</a>  
                                                    </div>
                                                    <div class="col">
                                                        <a href="?sort=product_asc"class="sort-font" style="font-size: 13px";>&nbsp;Name: A to Z</a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="?sort=product_desc" class="sort-font" style="font-size: 13px";>&nbsp;Name: Z to A</a>       
                                                    </div>
                                            </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <div style="float:right">
                                @if($subcat_selected != '')
                                    <h6 value="{{$subcat_selected->id}}" style="font-size: 13px";>{!! $subcat_selected->parentCategory->name !!} > {!! $subcat_selected->name !!}</h6>                            
                                @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($products->count() > 0)
                                    <div class="row row-cols-1 row-cols-md-4">
                                        @foreach ($products as $product)
                                            <div class="col" style="margin-bottom: 20px">
                                                <div class="card shadow-sm">
                                                    @if(isset($product->path))
                                                        <img src="{{ asset('storage/'.$product_images->path)}}" width="233" height="180">
                                                    @else
                                                        <img src="{{ asset('images/noimage.jpg') }}" width="233" height="180">
                                                    @endif    
                                                        <div class="card-body">
                                                            <p class="card-grid title"><strong>{{$product->name}}</strong></p>
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
@endsection
