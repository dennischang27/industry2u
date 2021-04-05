@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Center</b>
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
                        <li class="breadcrumb-item active">Customer Management</li>
                        <li class="breadcrumb-item active">Invite Customer</li>
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
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Invite Customer</h3>
                            </div>
                            @if($errors->any())
                              <h6><div class="text-danger" style="margin-left:20px;">{{$errors->first('message')}}</div></h6>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('user.customermanagement.mycustomer.invite.sendinvitation') }}" method="POST">
                                    @csrf
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif

                                    <div class="form-row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <label for="email">Date:</label>
                                        </div>
                                        <div class="col-md-9">
                                            {{date("Y-m-d")}}
                                        </div>
                                    </div>

                                    <div class="form-row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <label for="customer_company_name">Customer's Company Name: <small class="text-danger">*</small></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="customer_company_name" type="text" class="form-control" value="{{ old('customer_company_name') }}" name="customer_company_name" placeholder="Enter Customer's Company Name" style="height:40px;">
                                            @if ($errors->has('customer_company_name'))
                                                <span class="text-danger">{{ $errors->first('customer_company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <label for="customer_first_name">Customer's First Name: <small class="text-danger">*</small></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="customer_first_name" type="text" class="form-control" value="{{ old('customer_first_name') }}" name="customer_first_name" placeholder="Enter Customer's First Name" style="height:40px;">
                                            @if ($errors->has('customer_first_name'))
                                                <span class="text-danger">{{ $errors->first('customer_first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row" style="margin-bottom: 10px;">
                                            <div class="col-md-3">
                                                <label for="customer_last_name">Customer's Last Name: <small class="text-danger">*</small></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="customer_last_name" type="text" class="form-control" value="{{ old('customer_last_name') }}" name="customer_last_name" placeholder="Enter Customer's Last Name" style="height:40px;">
                                                @if ($errors->has('customer_last_name'))
                                                    <span class="text-danger">{{ $errors->first('customer_last_name') }}</span>
                                                @endif
                                            </div>
                                    </div>

                                    <div class="form-row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <label for="customer_email">Customer's Email: <small class="text-danger">*</small></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="customer_email" type="text" class="form-control" value="{{ old('customer_email') }}" name="customer_email" placeholder="Enter Customer's Email" style="height:40px;">
                                            @if ($errors->has('customer_email'))
                                                <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{ $companyId }}" name="company_id">

                                    <div class="form-row" style="margin-bottom: 10px;">
                                            <div class="col-md-3">
                                                <label class="float-left">Sales Executive: <small class="text-danger">*</small></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select title="Please Select Sales Executive" name="company_salesperson_id"
                                                        class="@error('company_salesperson_id') is-invalid @enderror form-control select2" id="company_salesperson_id" style="color:#6e707e;height:40px;">
                                                    <option value="">Please Select Sales Executive</option>
                                                    @foreach($salesExs as $s)
                                                        @if (old('company_salesperson_id') == $s->id)
                                                        <option value="{{$s->id}}" selected> {{ucwords($s->first_name)}} {{ucwords($s->last_name)}} </option>
                                                        @else
                                                        <option value="{{$s->id}}" /> {{ucwords($s->first_name)}} {{ucwords($s->last_name)}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('company_salesperson_id'))
                                                    <span class="text-danger">{{ $errors->first('company_salesperson_id') }}</span>
                                                @endif
                                            </div>
                                    </div>

                                  <br>
                                  <div class="form-group text-center">
                                      <button type="submit" class="btn btn-primary btn-sm">Send Invitation</button>
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



