@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Centre</b>
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
                        <li class="breadcrumb-item active">My Customer</li>
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
                                <h3>My Customer</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="fs-title">Customer Information</h5>
                                    <br>
                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Customer Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p> {{ $customerDetails->company_name }}</p>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Contact No:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $customerDetails->contact_no }}</p>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Address:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $customerDetails->street }} <br>
                                                {{ $customerDetails->postal_code }} {{ $customerDetails->city }}<br>
                                                {{ $customerDetails->state }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Postcode:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $customerDetails->postal_code }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>City:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>
                                                {{ $customerDetails->city }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>State:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>
                                                {{ $customerDetails->state }}
                                            </p>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Created at:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ date('d-m-Y', strtotime($customerDetails->customer_created_at)) }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="fs-title">SSM Documents</h5>
                                    <br>
                                    <div class="row">
                                        @foreach($document_list as $document)
                                            @if($document->name == 'SSM Form 9')
                                            <div class="col-md-4">
                                                <label style="font-weight: 700">{{ __($document->name) }} : </label>
                                            </div>
                                            <div class="col-md-8">
                                                @if(isset($myDocuments[$document->id]))
                                                    <a href="{{ asset('storage/'.$myDocuments[$document->id]->file_path) }}" 
                                                        target="_blank">My {{ $myDocuments[$document->id]->doc_type->name }}</a>
                                                @endif
                                            </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <a href="{{ route('user.customermanagement.mycustomer.index') }}" class="btn btn-secondary btn-sm" >
                                            Back    
                                        </a>
                    

                                            <a 
                                            href="{{ route('user.customermanagement.mycustomer.manage', $customerDetails->purchaser_company_id) }}" 
                                            class="btn btn-outline-primary btn-sm" style="float: right" >
                                                Manage By Products
                                            </a>

                                            <a 
                                            href="{{ route('user.customermanagement.mycustomer.managebycategory', $customerDetails->purchaser_company_id) }}" 
                                            class="btn btn-outline-primary btn-sm" style="float: right" >
                                                Manage By Category
                                            </a>

                                            
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

