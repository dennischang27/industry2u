@extends('layouts.app')

@section('style')
    <style>
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 30%;
            height: 30%;
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
        label {
            margin-top:13px;
        }
        .form-control, .form-control:focus {
            color: #6C757D;
        }
        #bankinfoform > .row{
            margin-bottom: 10px;
        }
    </style>

@endsection

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
                        <li class="breadcrumb-item active">Company Profile</li>
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
                                <h3>Payment Information</h3>
                            </div>
                            <div class="card-body">
                                <form id="bankinfoform" novalidate class="form" method="post" enctype="multipart/form-data"
                                        action="{{route('user.bankinfo.store', $company)}}">
                                        @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="bank_name">{{ __('Bank Name') }}:<small class="text-danger">*</small></label>
                                        </div>
                                        <div class="col-md-8">
                                        <select title="Please select Bank Name" required name="bank_id"
                                                class="@error('bank_id') is-invalid @enderror form-control select2" id="bank_id">
                                            <option value=""><span style="color:blue;">Please select Bank Name</span></option>
                                            @foreach($bank as $s)
                                                <option value="{{$s->id}}" {{ old('bank_id') == $s->id ? "selected" : "" }} {{ $company->bank_id == $s->id ? "selected='selected'" : "" }}> {{$s->name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="errorTxt"></div>
                                        @error('bank_id')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="float-left">{{ __('Bank Account Number') }}: <small class="text-danger">*</small></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control @error('bank_account') is-invalid @enderror" value="{{old('bank_account') ? old('bank_account') : $company->bank_account}}"
                                                title="Invalid bank account no." required number type="text" name="bank_account"
                                                placeholder="{{ __('Please enter bank account number') }}" />
                                            <div class="errorTxt"></div>
                                            @error('bank_account')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>{{ __('SST Number') }}:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input pattern="[0-9]+" class="form-control @error('sst_no') is-invalid @enderror" value="{{old('sst_no') ? old('sst_no') : $company->sst_no}}"
                                                title="Invalid SST number" required number type="text" name="sst_no"
                                                placeholder="{{ __('Please enter SST number') }}" />
                                            <div class="errorTxt"></div>
                                            @error('sst_no')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                    @foreach($doc_type_sst as $doc_type)
                                        <div class="col-md-4">
                                            <label>{{ __($doc_type->name) }}:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input id="sstfile_{{ $doc_type->id }}" accept="image/png, image/jpeg, application/pdf" type="file"
                                            class="form-control @error('sstfile.' .$doc_type->id) is-invalid @enderror"
                                            value="{{ old('sstfile') ? old('sstfile')[$doc_type->id] : null }}" name="sstfile[{{ $doc_type->id }}]" autofocus />
                                            @error('sstfile.' . $doc_type->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group text-right">
                                        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Update" />
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
