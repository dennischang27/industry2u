@extends('admin.layouts.app')
@section('style')
    <style>
        .custom-well {
            color: #fff;
            background: #3c8dbc;
            border: 1px solid #3c8dbc
        }
        .swatches-container .header {
            display:flex;
            flex-direction:row;
            font-weight:700;
            background-color: #3694d3;
            color:#fff
        }
        .swatches-container .header>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .header:before {
            content:"#";
            display:inline-block;
            width:50px;
            text-align:center;
            line-height:40px
        }
        .swatches-container .header .swatch-slug,
        .swatches-container .header .swatch-title,
        .swatches-container .header .swatch-min,
        .swatches-container .header .swatch-max,
        .swatches-container .header .swatch-value {
            flex:1
        }
        .swatches-container .header .action-item {
            width:80px
        }
        .swatches-container .swatches-list {
            float:left;
            list-style:none;
            margin:0 0 15px;
            padding:0;
            width:100%;
            counter-reset:swatches-list
        }
        .swatches-container .swatches-list li {
            padding-left:50px;
            display:flex;
            flex-direction:row;
            align-items:center;
            position:relative;
            counter-increment:swatches-list
        }
        .swatches-container .swatches-list li+li {
            margin-top:1px
        }
        .swatches-container .swatches-list li:nth-child(odd) {
            background-color:#f0f0f0
        }
        .swatches-container .swatches-list li:before {
            content:counter(swatches-list);
            width:50px;
            position:absolute;
            height:100%;
            top:0;
            left:0;
            cursor:move;
            background-color:#bbb;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center
        }
        .swatches-container .swatches-list li>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .swatches-list li .swatch-slug,
        .swatches-container .swatches-list li .swatch-min,
        .swatches-container .swatches-list li .swatch-max,
        .swatches-container .swatches-list li .swatch-title,
        .swatches-container .swatches-list li .swatch-value {
            flex:1
        }
        .swatches-container .swatches-list li .image-box-container img {
            border:1px solid #ccc;
            width:34px;
            height:34px
        }
        .swatches-container .swatches-list li .action-item {
            width:100px
        }
        .swatches-container .swatches-list .list-photo-hover-overlay {
            display:none
        }

    </style>

@endsection
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Company - {{ $company->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.companies.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($company, ['method' => 'PATCH','route' => ['admin.companies.update', $company->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Company Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Company Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Registration Number:</strong>
                        {!! Form::text('reg_no', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Admin User:</strong>
                        {{ $company->adminUser->first_name  }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Phone:</strong>
                        {!! Form::text('phone', null, array('placeholder' => 'phone','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>SST NO:</strong>
                        {!! Form::text('sst_no', null, array('placeholder' => 'sst no','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for=""><strong>Is Buyer:</strong></label>
                        <div class="form-control">
                            <div class="onoffswitch">
                                <input type="hidden" name="is_buyer" value="0">
                                <input type="checkbox" name="is_buyer" class="onoffswitch-checkbox" data-target="#attributemeasurementdiv" id="is_buyer" value="1" @if ($company->is_buyer) checked @endif >
                                <label class="onoffswitch-label" for="is_buyer">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for=""><strong>Is Seller:</strong></label>
                        <div class="form-control">
                            <div class="onoffswitch">
                                <input type="hidden" name="is_seller" value="0">
                                <input type="checkbox" name="is_seller" class="onoffswitch-checkbox" data-target="#attributemeasurementdiv" id="is_seller" value="1" @if ($company->is_seller) checked @endif >
                                <label class="onoffswitch-label" for="is_seller">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Bank Name:</strong>
                        {!! Form::select('bank_id',$banks, $company->bank_id, array('placeholder' => 'Bank','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Bank Account Number:</strong>
                       {!! Form::text('bank_account', null, array('placeholder' => 'Bank Account No','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
