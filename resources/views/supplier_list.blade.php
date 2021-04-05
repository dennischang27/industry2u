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
        <input type="hidden" value="{{ request()->input('q') }}" name="q"  >
                <div class="container">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="input-group">
                                        <input class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Search Supplier..."  type="text">
                                        <input class="form-control" name="categoryid" value="{{ request()->input('name') }}" type="hidden">
                                            <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                                    </div>
                                </div>
                                    <div class="product_header_right">
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
                                    
                        @if ($companies->count() > 0)
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5" style="margin-bottom: 20px">
                                @foreach($companies as $company)
                                    <div class="col" style="margin-bottom: 20px">
                                        <div class="card shadow-sm">
                                            @if(isset($company->logo))
                                                <img src="{{ asset('storage/'.$company->logo) }}"  width="254" height="180">
                                            @else
                                                <img src=" {{ asset('images/noimage.jpg') }}"  width="200" height="180">
                                            @endif    
                                                <div class="card-body">
                                                    <p class="card-text"><strong>{{ $company->name}} </strong></p>
                                                        <div class="btn-group">
                                                            <a href="{{route('company_profile',$company->id)}}" class="btn btn-sm btn-outline-primary pull-right">View</a>
                                                        </div>
                                                </div>
                                        </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        @else
                            <br>
                            <div class="col text-center">{{ __('No Companies!') }}</div>        
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
        $(document).ready(function() {
            var searchForm2Div = document.getElementById("serch_form2");
            searchForm2Div.style.display = "none";

            var searchFormDiv = document.getElementById("serch_form");
            searchFormDiv.style.display = "none";
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
