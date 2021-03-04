@extends('seller.layouts.app')

@section('style')
    <style>
        .profile-img{
            text-align: center;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><span>Discount Setting</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
@endsection

@section('content')
    <div class="col-12 mt-5">
        <div class="card-header">
            <h3>Discount Settings</h3>
        </div>
        <div class="card-body">

            <h5>Master</h5>

            @if ($discount != null)
    
                <table class="table table-bordered"  id="dataTable" width="50%" cellspacing="0">
                    <tr>
                        <th>Discount Tier 1</th>
                        <th>Discount Tier 2</th>
                        <th>Discount Tier 3</th>
                        <th width="280px">Action</th>
                    </tr>
                    {{-- @foreach ($data as $key => $company) --}}
                        <tr>
                            <td>{{$discount->master_tier1}}</td>
                            <td>{{$discount->master_tier2}}</td>
                            <td>{{$discount->master_tier3}}</td>

                            <td>
                                <a class="btn btn-primary btn-sm" style="color: white;"
                                {{-- href="{{ route('admin.companies.edit',$company->id) }}" --}}
                                href="{{ route('seller.discount.master') }}"
                                >Edit</a>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </table>
    
            @else
                <a class="btn btn-primary btn-sm" style="color: white;" href="{{ route('seller.discount.master') }}">Add Master Discount Setting</a>

                <br>
            @endif

            <br />

            <h5>Manager</h5>

                @if ($discount != null)
                    <table class="table table-bordered"  id="dataTable" width="50%" cellspacing="0">
                        <tr>
                            <th>Discount Tier 1</th>
                            <th>Discount Tier 2</th>
                            <th>Discount Tier 3</th>
                            <th width="280px">Action</th>
                        </tr>
                        {{-- @foreach ($data as $key => $company) --}}
                            <tr>
                                <td>{{$discount->manager_tier1}}</td>
                                <td>{{$discount->manager_tier2}}</td>
                                <td>{{$discount->manager_tier3}}</td>
        
                                <td>
                                    <a class="btn btn-primary btn-sm" style="color: white;"
                                    {{-- href="{{ route('admin.companies.edit',$company->id) }}" --}}
                                    href="{{ route('seller.discount.manager') }}"
                                    >Edit</a>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </table>
                @else
                    <a class="btn btn-primary btn-sm" style="color: white;" href="{{ route('seller.discount.manager') }}">Add Manager Discount Setting</a>
                    <br>
                @endif

            <br />

            <h5>Sales</h5>

            @if ($discount != null)
                <table class="table table-bordered"  id="dataTable" width="50%" cellspacing="0">
                    <tr>
                        <th>Discount Tier 1</th>
                        <th>Discount Tier 2</th>
                        <th>Discount Tier 3</th>
                        <th width="280px">Action</th>
                    </tr>
                    {{-- @foreach ($data as $key => $company) --}}
                        <tr>
                            <td>{{$discount->sales_tier1}}</td>
                            <td>{{$discount->sales_tier2}}</td>
                            <td>{{$discount->sales_tier3}}</td>

                            <td>
                                <a class="btn btn-primary btn-sm" style="color: white;"
                                {{-- href="{{ route('admin.companies.edit',$company->id) }}" --}}
                                href="{{ route('seller.discount.sales') }}"
                                >Edit</a>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </table>
            @else
                <a class="btn btn-primary btn-sm" style="color: white;" href="{{ route('seller.discount.sales') }}">Add Sales Discount Setting</a>
            @endif
            
            {{-- <div class="row">
                

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group row">
                        <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                        <div class="col-sm-9">
                        <input class="form-control" name="description" placeholder="discount tier 1" title="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                        <div class="col-sm-9">
                        <input class="form-control" name="description" placeholder="discount tier 2" title="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                        <div class="col-sm-9">
                        <input class="form-control" name="description" placeholder="discount tier 3" title="" required>
                        </div>
                    </div>
                    

                </div>



            </div>

            <div class="" style="margin-top: 5%">
                <button type="button" class="btn btn-success" style="float: right;">Save</button>
            </div> --}}


        </div>
    </div>
@endsection


