@extends('layouts.app')


@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Management Centre</b>
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
                        <li class="breadcrumb-item active">Discount Settings</li>
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
                <div class="col-lg-3 col-md-4">
                    @include('layouts.managementsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">

                        <div class="card">
                            <div class="card-header">
                                <h3>Discount Settings</h3>
                            </div>
                            <div class="card-body">

                                <br>
                                <h5>Maximum Discount Limit</h5>
                                {{-- <h5>Master</h5> --}}
                                <br>

                                @if ($discount->master_tier1 != null && $discount->master_tier2 != null && $discount->master_tier3 != null)

                                    <table class="table" class="text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">Discount Tier 1</th>
                                            <th scope="col">Discount Tier 2</th>
                                            <th scope="col">Discount Tier 3</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <th>{{$discount->master_tier1}}</th>
                                            <th>{{$discount->master_tier2}}</th>
                                            <th>{{$discount->master_tier3}}</th>
                
                                            <td>
                                                <a class="btn btn-primary btn-xs" style="color: white;"
                                                href="{{ route('user.discount.masters')}}">Edit</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>                        
                        
                                @else
                                    <a class="btn btn-primary btn-sm" style="color: white;" href="{{ route('user.discount.masters') }}">Add Master Discount Setting</a>
                                    <br>
                                @endif
                    
                                <br /><br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




