<style>
    /* .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding : 0px !important;
    margin-left: 0px;
    display: inline;
    border: 0px;
} */

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
 <!-- breadcrumbs start here-->
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
                    <li class="breadcrumb-item active">Customer Re-assign</li>
                </ol>

            </div>
        </div>
    </div>
</div>
@endsection


@section('plugin_style')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

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
                                <h3>Customer Re-assign</h3>   
                            </div>
                            <div class="card-body">

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <div id="error" class="invalid-feedback text-danger alert alert-danger" role="alert">
                                    <strong>Please select a customer to reassign sales executive.</strong>
                                </div>
                                <br/>

                                <div class="single-table">
                                    <div class="data-tables">
                                        <form id="reassign-form" class="form--shopping-cart" method="post" action="{{ route("user.customermanagement.mycustomer.customerReassign.reassign") }}">
                                            @csrf
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col" data-orderable="false" class="no-sort">
                                                        <input type="checkbox" class="checked_all">
                                                    </th>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Date Joined</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Business Type</th>
                                                    <th scope="col">Sales Executive</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">

                                                @foreach ($customerList as $customer)
                                                <tr>
                                                    <td><input id='customer_id[]' name='customer_id[]' type="checkbox" class="checkbox" value="{{$customer->id}}"></td>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{date('d/m/Y', strtotime($customer->customer_created_at))}}</td>
                                                    <td>{{ ucwords( $customer->customer_company) }} </td>
                                                    <td>{{ $customer->customer_industry_name}}</td>
                                                    <td>{{ ucwords($customer->salesEx_first_name) }} {{ ucwords($customer->salesEx_last_name) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="ex_id" name="ex_id">
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <a class="btn btn-sm btn-success" style="float: right; color:white" onclick="onUpdateClick()">
                                    Update
                                </a>
                                    <div class="modal fade" id="salesExModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header" style="text-align: left">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">
                                            </h4>
                                          </div>
                                          <div class="modal-body" style="text-align: left">
                                            <h6>Date: {{ date('d-m-Y') }}</h6>
                                            <br />

                                            <div id="error-msg" class="invalid-feedback text-danger alert alert-danger" role="alert">
                                                <strong>Please select a sales executive.</strong>
                                            </div>
                                            <br/>

                                            <h6>Sales Executive:</h6>
                                            <select class="form-control" id="sales_ex_id" name="sales_ex_id">
                                                <option selected disabled>Select Sales Executive</option>
                                                @foreach ($salesExs as $saleExs)
                                                    <option value="{{ $saleExs->user_id }}">
                                                        {{ ucwords($saleExs->first_name) }} {{ ucwords($saleExs->last_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                          </div>
                                          <div class="modal-footer">
                                            <button id="btnModalSave" type="button" class="btn btn-primary btn-sm">Save</button>
                                            {{-- <button id="btnModalSave" type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Save</button> --}}
                                          </div>
                                        </div>
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

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

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
                    "order": [],
                    "columnDefs": [{
                        "targets": 'no-sort',
                        "orderable": false,
                    }]
                });
        }

    </script>

    <script type="text/javascript">
        $('.checked_all').on('change', function() {     
            $('.checkbox').prop('checked', $(this).prop("checked"));              
        });

        $('#btnModalSave').on('click', function() {     
            var sales_ex_id = $('#sales_ex_id').val();
            $('#ex_id').val(sales_ex_id);
            if(sales_ex_id == null){
                $('#error-msg').show();
                $("#salesExModal").modal("show");
            } else {
                $('#error-msg').hide();
                $( "#reassign-form" ).submit();
            }
        });
        
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked    
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('.checked_all').prop('checked',true);
            }else{
                $('.checked_all').prop('checked',false);
            }
        });

        function onUpdateClick(){
            console.log('update is click');
            var n = $( "input:checked[name='customer_id[]" ).length;
            console.log(n);
            if(n==0){
                console.log('show error and hide modal');
               // $("#salesExModal").modal("hide");
                $('#error').show();
            }else{
                $("#salesExModal").modal("show");
                $('#error').hide();
            }

        }
    </script>
@endsection



