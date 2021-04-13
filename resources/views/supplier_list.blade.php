@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' SUPPLIER LIST') }}</title>
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
    .column {
        float: left;
        width: 50%;
        padding: 10px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    /* .text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
    }    */
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
                        <h1>SUPPLIER LIST</h1>
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
                        <li class="breadcrumb-item active">SUPPLIER LIST</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="section">
    <form id="searchCompanies" action="{{ URL::current() }}" method="GET">
                <div class="container">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="input-group">
                                        <input class="form-control" name="sup" value="{{ request()->input('sup') }}" placeholder="Search Supplier..."  type="text">
                                        <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                                    </div>
                                </div>
                                    <div class="product_header_right">
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm submit-form-on-change" name="num">
                                                <option value="">{{ __('Showing') }}</option>
                                                <option value="15" @if (request()->input('num') == 15) selected @endif>15</option>
                                                <option value="25" @if (request()->input('num') == 25) selected @endif>25</option>
                                                <option value="40" @if (request()->input('num') == 40) selected @endif>40</option>
                                            </select>
                                        </div>
                                            </div>
                                    </div>
                                    </div>
                            </div>
                        @if ($companies->count() > 0)
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5" style="margin-bottom: 20px">
                                @foreach($companies as $company)
                                    <div class="col" style="margin-bottom: 20px">
                                        <div class="card shadow-sm">
                                         <a href="{{route('company_profile',$company->id)}}">
                                            @if(isset($company->logo))
                                                <img src="{{ asset('storage/'.$company->logo) }}"  width="195" height="180">
                                            @else
                                                <img src="{{ asset('images/noimage.jpg') }}"  width="200" height="180">
                                            @endif
                                                <div class="card-body">
                                                <div class="text">
                                                    <strong>{{ str_limit($company->name, 33) }}</strong><br><br>
                                                    <a href="{{route('company_profile',$company->id)}}" class="btn btn-sm btn-outline-primary pull-right">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                    
                            </div>
                            <div class="col-12">
                                <div class="justify-content-center ">
                                    {!! $companies->appends(request()->query())->links() !!}
                                </div>
                            </div>
                        @else
                            <br><div class="col text-center">{{ __('No Companies!') }}</div>
                        @endif
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
        $('#searchCompanies').submit(function() {
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
