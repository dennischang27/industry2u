<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline;
        min-width: 1.5em;
        padding: 0px !important;
        margin-left: 0px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *: ;
        cursor: hand;
        color: #333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 0px;
    }
</style>

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
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_style')
    <link href="{{ asset('assets/datatables/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/responsive.jqueryui.min.css') }}" rel="stylesheet" type="text/css">
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
                                <h3>My Supplier</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center row-border">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Date Joined</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col" data-orderable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                {{-- @foreach ($customerList as $customer)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($customer->customer_created_at)) }}</td>
                                                        <td>{{ $customer->customer_company }}</td>
                                                        <td>{{ $customer->customer_industry_name }}</td>
                                                        <td>
                                                            <a class="btn btn-xs btn-primary" style="color: white" href="{{ route('user.customermanagement.mycustomer.detials', $customer->customer_id) }}">
                                                            Details
                                                            </a>
                                                        </td>

                                                    </tr>  
                                                @endforeach --}}
                                            </tbody>
                                        </table>
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


@section('plugin_script')
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/responsive.bootstrap.min.js') }}"></script>

    <script>
        if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    responsive: false,
                    language: {
                        paginate: {
                            next: '>', // or '→'
                            previous: '<' // or '←' 
                        }
                    },
                });
        }

    </script>
@endsection
