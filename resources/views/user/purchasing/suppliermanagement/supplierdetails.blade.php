@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Purchasing Center</b>
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
                        <li class="breadcrumb-item active">Supplier Management</li>
                        <li class="breadcrumb-item active">My Supplier</li>
                        <li class="breadcrumb-item active">Supplier Details</li>
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
                    @include('layouts.purchasingsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Supplier Details</h3>
                                
                            </div>
                            <div class="card-body">
                                <br>
                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Customer Name:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p> {{ $supplierDetails->company_name }}</p>
                                    </div>
                                </div>
                                <br />

                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Contact No:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $supplierDetails->phone }}</p>
                                    </div>
                                </div>
                                <br />
                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Address:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $supplierDetails->street }} <br>
                                            {{ $supplierDetails->postal_code }} {{ $supplierDetails->city }}<br>
                                            {{ $supplierDetails->state }}
                                        </p>
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Postcode:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $supplierDetails->postal_code }}</p>
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>City:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>
                                            {{ $supplierDetails->city }}
                                        </p>
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>State:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>
                                            {{ $supplierDetails->state }}
                                        </p>
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Created at:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ date('d-m-Y', strtotime($supplierDetails->created_at)) }}</p>
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="form-group">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm" >
                                        Back    
                                    </a>
                                </div>
                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


