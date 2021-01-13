@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
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
        .select2-selection__rendered {
            line-height: 37px !important;
        }
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        .select2-container  {
            margin-bottom: 15px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
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
                        <li class="breadcrumb-item active">
                            <a href="{{route("user.company")}}" itemprop="item" title="Home">
                                Company Profile
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Company Profile Edit</li>
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
                    @include('layouts.usersidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">

                        <div class="card">
                            <div class="card-header">
                                <h3>Company Profile</h3>
                            </div>
                            <div class="card-body">
                                <form id="companyprofileform" novalidate class="form" method="post" enctype="multipart/form-data"
                                      action="{{route('user.company.update', $company)}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="first_name">Company Name<small class="text-danger">*</small></label>
                                        <input class="form-control @error('name') is-invalid @enderror" value="{{ $company->name }}"
                                               title="Please enter company name" required disabled type="text" name="name"
                                               placeholder="Please enter company name" />
                                        <div class="errorTxt"></div>
                                        @error('name')
                                        <span class="invalid-feedback text-danger" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label >{{ __('Business Registration Number') }} <small class="text-danger">*</small></label>
                                        <input class="form-control @error('reg_no') is-invalid @enderror" required name="reg_no" disabled type="text"
                                               value="{{ $company->reg_no }}" placeholder="Please Enter Business Registration Number"
                                               title="Please Enter Business Registration Number.">
                                        <div class="errorTxt"></div>
                                        @error('reg_no')
                                        <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="float-left">{{ __('Business Type') }}: <small class="text-danger">*</small></label>
                                            <select title="Please select business type" required name="industry_id"
                                                    class="@error('industry_id') is-invalid @enderror form-control select2" id="industry_id">
                                                <option value="">Please select business type</option>
                                                @foreach($industry as $s)
                                                    <option value="{{$s->id}}"{{$s->id==$company->industry_id ? "selected":""}} /> {{$s->name}} </option>
                                                @endforeach
                                            </select>
                                            <div class="errorTxt"></div>
                                            @error('industry_id')
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="float-left">{{ __('Monthly Budget Range') }}: <small class="text-danger">*</small></label>
                                            <select title="lease Monthly Budget Range" required name="company_budget_range_id"
                                                    class="@error('company_budget_range_id') is-invalid @enderror form-control select2" id="company_budget_range_id">
                                                <option value="">Please Monthly Budget Range</option>
                                                @foreach($companybudgetrange as $s)
                                                    <option value="{{$s->id}}"  {{$s->id==$company->company_budget_range_id ? "selected":""}}/> {{$s->name}} </option>
                                                @endforeach
                                            </select>
                                            <div class="errorTxt"></div>
                                            @error('company_budget_range_id')
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Contact Number') }} <small class="text-danger">*</small></label>
                                        <input class="form-control @error('phone') is-invalid @enderror" required number name="phone" pattern="[0-9]+" type="text"
                                               value="{{ $company->phone }}" placeholder="Please Enter Contact Number."
                                               title="Please Enter Valid Phone No">
                                        <div class="errorTxt"></div>
                                        @error('phone')
                                        <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">{{ __('Address') }} <small class="text-danger">*</small></label>
                                        <input class="form-control @error('street') is-invalid @enderror" required name="street" type="text"
                                               value="{{ $company->street }}" placeholder="Please Enter Company Address"
                                               title="Please Enter Company Address">
                                        <div class="errorTxt"></div>
                                        @error('street')
                                        <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="float-left">{{ __('Postal Code') }}: <small class="text-danger">*</small></label>
                                            <input class="form-control @error('postal_code') is-invalid @enderror" title="Please enter valid Postal Code" required number name="postal_code"
                                                   type="text" value="{{ $company->postal_code }}" placeholder="{{ __('Please enter valid Postal Code') }}">
                                            <div class="errorTxt"></div>
                                            @error('postal_code')
                                            <span class="invalid-feedback text-danger" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label class="float-left">{{ __('City') }}: <small class="text-danger">*</small></label>
                                                <input class="form-control @error('city') is-invalid @enderror" title="Please enter City" required name="city"
                                                       type="text" value="{{ $company->city }}" placeholder="{{ __('Please enter City') }}">
                                                <div class="errorTxt"></div>
                                                @error('city')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" value="1">
                                    <div class="form-group">
                                        <label class="float-left">{{ __('State') }}: <small class="text-danger">*</small></label>
                                        <select title="Please select State" required name="state_id"
                                                class="@error('state_id') is-invalid @enderror form-control select2" id="state_id">
                                            <option value="">Please select state</option>
                                            @foreach($state as $s)
                                                <option value="{{$s->id}}" {{$s->id==$company->state_id ? "selected":""}} /> {{$s->name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="errorTxt"></div>
                                        @error('state_id')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Company logo') }}:</label>
                                        <br>
                                        @if($image = @file_get_contents(asset('storage/'.$company->logo)))
                                            <img src="{{ asset('storage/'.$company->logo) }}" width="100" height="100">
                                        @else
                                            <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                        @endif
                                        <br>
                                        <input type="file" name="logo" accept="image/png, image/jpeg"  class="form-control @error('logo') is-invalid @enderror">
                                        @error('logo')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                    <br>
                                    <h3 class="fs-title">SSM Documents</h3>
                                    <div class="form-row">
                                        @foreach($document_list as $doc_type)
                                            <div class="form-group col-md-4">
                                                <label >{{ __($doc_type->name) }}:</label>
                                                <br>
                                                @if(isset($myDocuments[$doc_type->id]))
                                                    <a href="{{ asset('storage/'.$myDocuments[$doc_type->id]->file_path) }}" target="_blank">My {{ $myDocuments[$doc_type->id]->doc_type->name }}</a>
                                                @endif
                                                <input id="file_{{ $doc_type->id }}" accept="jpg, jpeg, png, pdf" type="file"
                                                       class="form-control @error('file.' .$doc_type->id) is-invalid @enderror"
                                                       value="{{ old('file') ? old('file')[$doc_type->id] : null }}" name="file[{{ $doc_type->id }}]" autofocus />
                                                @error('file.' . $doc_type->id)
                                                <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                                @enderror
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-fill-out btn-sm">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>


        $('.select2').select2({
            allowClear: true,
            width: '100%'
        });
    </script>
@endsection
