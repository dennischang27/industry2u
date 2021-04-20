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
                        <li class="breadcrumb-item active">My Customer</li>
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
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>My Customer</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center row-border">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Date Joined</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Industry</th>
                                                    <th scope="col">Payment Terms</th>
                                                    <th scope="col" data-orderable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                @foreach ($customerList as $customer)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($customer->customer_created_at)) }}</td>
                                                        <td>{{ ucwords($customer->company_name) }}</td>
                                                        <td>{{ $customer->customer_industry_name }}</td>
                                                        <td>{{ $customer->payment_term_days }}</td>
                                                        <td>
                                                            <a class="btn btn-xs btn-primary" style="color: white" href="{{ route('user.customermanagement.mycustomer.detials', $customer->company_id) }}">
                                                            Details
                                                            </a>
                                                            <br />
                                                            <button type="button" onclick="term({{$customer->purchaser_company_id}}, {{$customer->payment_term_days}})" class="btn btn-xs btn-success" id="term" name="term">Term</button>
                                                        </td>

                                                    </tr>  
                                                @endforeach
                                            </tbody>

                                            <div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form id="term_form" method="POST" action="{{route('user.customermanagement.mycustomer.updateTerm')}}">
                                                            @csrf
                                                            <div class="modal-header" style="text-align: left">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Payment Term
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body" style="text-align: left">
                                                                <div class="form-group row">
                                                                    <label for="payment_term" class="col-sm-12 col-form-label"><strong>Payment Term:</strong><small class="text-danger">*</small></label>
                                                                    <div class="col-sm-12">
                                                                    <select required name="payment_term"
                                                                            class="@error('payment_term') is-invalid @enderror form-control select2" id="payment_term">
                                                                        <option value="" selected disabled>Please select payment term</option>
                                                                        @foreach($terms as $term)
                                                                            <option value="{{$term->days}}"> {{$term->code}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="payment_term_error" class="invalid-feedback text-danger" role="alert">
                                                                        <strong>Please select payment term</strong>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="purchaser_company_id" name="purchaser_company_id" value=''>
                                                                <input type="hidden" id="term_code" name="term_code" value=''>
                                                                <div class="col text-center">
                                                                    <button type="button" class="btn btn-fill-out" id="submit_term" name="submit_term">Submit</button>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                </div>
                                            </div>
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

        function term(purchaser_company_id, payment_term_days){
            $("#purchaser_company_id").val(purchaser_company_id);
            $("#payment_term").val(payment_term_days);
            $('#termModal').modal('show');
        }

        $( "#payment_term" ).change(function() {
            var value = $(this).find("option:selected").text();
            $("#term_code").val(value);
        });

        $( "#submit_term" ).on( "click", function() {
   
            var selectedValue = document.getElementById("payment_term").value;

            if(selectedValue == ''){
                $('#payment_term_error').show();
                $('#termModal').modal('show');
            } else {
                $('#payment_term_error').show();
                $( "#term_form" ).submit();
            }
        });


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
