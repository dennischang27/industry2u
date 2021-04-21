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
                        <li class="breadcrumb-item active">Quotation</li>
                        <li class="breadcrumb-item active">To Quote</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/responsive.jqueryui.min.css') }}">
    <style>
        td.child{
            text-align: left;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding:0px;
        }
        table.dataTable thead .sorting_asc::before, table.dataTable thead .sorting::before, table.dataTable thead .sorting_desc::before{
            content: "";
        }
        table.dataTable thead .sorting_asc::after, table.dataTable thead .sorting::after, table.dataTable thead .sorting_desc::after{
            content: "";
        }
        #submit_add_discount{
            margin-top:30px;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before{
            
        }
        .btn-custom{
            border-radius: .25rem;
        }
    </style>
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
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3>Customer: {{$cust_company}}</h3>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button type="button" onclick="view()" class="btn-custom btn-fill-out-green mt-1" id="quote" name="quote">Quote</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <div id="quotation_request_error" class="invalid-feedback text-danger" role="alert">
                                    <strong>Please select quotation request.</strong>
                                </div><br/>
                                <div class="single-table">
                                    <div class="data-tables">
                                    <form id="to-quote-form" class="form--shopping-cart" method="post" action="{{ route("buyer.quotationrequest") }}">
                                    @csrf
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th>No</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">List Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">UOM</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Quotation Amount</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                @if($qr_details)
                                                    @foreach ($qr_details as $qr_detail)
                                                        <tr>
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{date('d/m/Y', strtotime($qr_detail->updated_at))}}</td>
                                                            <td>{{$qr_detail->product_name}}</td>
                                                            <td>{{$qr_detail->brand->name}}</td>
                                                            <td>{{number_format($qr_detail->price, 2)}}</td>
                                                            <td>{{$qr_detail->quantity}}</td>
                                                            <td>{{$qr_detail->uom}}</td>
                                                            <td>{{$qr_detail->total_discount}}</td>
                                                            <td>{{number_format($qr_detail->total_amount, 2)}}</td>
                                                            <td>
                                                                <button onclick="showDiscountModal({{$qr_detail->id}},'{{$qr_detail->product_name}}',{{$qr_detail->price}},{{$qr_detail->quantity}})" type="button" class="btn-custom btn-fill-out-yellow" id="discount" name="discount">Discount</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="action" name="action" value="">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                @hasanyrole('Purchasing Moderator|Purchasing Manager|Purchasing Executive')
                                                    <button type="button" class="btn btn-fill-out" id="submit_quote" name="submit_quote">Submit</button>
                                                    <button type="button" class="btn btn-fill-out-red" id="reject" name="reject">Reject</button>
                                                @endhasanyrole
                                                @hasanyrole('Engineer|Clerical Staff')
                                                    <button type="button" class="btn btn-fill-out-red" id="cancel" name="cancel">Cancel</button>
                                                @endhasanyrole
                                            </div>
                                        </div>
                                    </form>
                                        <div class="modal fade" id="cancelQuotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="text-align: left">
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            <label for="cancel" class="col-sm-12 col-form-label">Cancel Quotation Request</label>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left">
                                                        <form id="cancel_quotation_form" method="POST" action="{{route('buyer.cancelquotationrequest')}}">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <div class="form-group row">
                                                                            <label for="cancel" class="col-sm-12 col-form-label">
                                                                                <strong>Are you sure you want to cancel selected quotation request?</strong>
                                                                            </label>
                                                                        </div>
                                                                        <input type="hidden" id="cancel_qr_id" name="cancel_qr_id" value=''>
                                                                        <div class="col text-center">
                                                                            <button type="button" class="btn btn-fill-out" id="submit_cancel" name="submit_cancel">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="modal fade" id="addDiscount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="text-align: left">
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            Add Discount
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left">
                                                        <form id="add_discount_form" method="POST" action="{{route('seller.adddiscount')}}">
                                                        @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-5">
                                                                                Product Name:
                                                                            </div>
                                                                            <div class="col-sm-7">
                                                                                <span id="product_name"><span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-5">
                                                                                List Price:
                                                                            </div>
                                                                            <div class="col-sm-7">
                                                                                <span id="displayprice"><span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-5">
                                                                                Discount Tier 1 (%):
                                                                            </div>
                                                                            <div class="col-sm-7">
                                                                                <input class="form-control" type="number" min="0" max="100" id="t1" name="t1" onblur="validateT1(this)"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-5">
                                                                                Discount Tier 2 (%):
                                                                            </div>
                                                                            <div class="col-sm-7">
                                                                                <input class="form-control" type="number" min="0" max="100" id="t2" name="t2" onkeyup="validateT2(this)"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-5">
                                                                                Discount Tier 3 (%):
                                                                            </div>
                                                                            <div class="col-sm-7">
                                                                                <input class="form-control" type="number" min="0" max="100" id="t3" name="t3" onkeyup="validateT3(this)"/>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" id="qr_detail_id" name="qr_detail_id" value=''>
                                                                        <input type="hidden" id="price" name="price" value=''>
                                                                        <input type="hidden" id="quantity" name="quantity" value=''>
                                                                        <div class="col text-center">
                                                                            <button type="button" class="btn btn-fill-out" id="submit_add_discount" name="submit_add_discount">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/responsive.bootstrap.min.js') }}"></script>
    <script>

        function validateT1(e){
            var price = parseFloat($('#price').text());
            var t1 = $('#t1').val();
            var t2 = $('#t2').val();
            var t3 = $('#t3').val();

            var t1_price = price - price * (t1/100);
            var t2_price = t1_price - t1_price * (t2/100);
            var t3_price = t2_price - t2_price * (t3/100);
        }

        function validateT2(e){
            var price = parseFloat($('#price').text());
            var t1 = $('#t1').val();
            var t2 = $('#t2').val();
            var t3 = $('#t3').val();
        }

        function validateT3(e){
            var price = parseFloat($('#price').text());
            var t1 = $('#t1').val();
            var t2 = $('#t2').val();
            var t3 = $('#t3').val();
        }

        function view(){
            window.location.href = "../../quote";
        }

        function showDiscountModal(id, product_name, price, quantity){
            $('#qr_detail_id').val(id);
            $('#product_name').text(product_name);
            $('#displayprice').text(price.toFixed(2));
            $('#price').val(price.toFixed(2));
            $('#quantity').val(quantity);
            $('#addDiscount').modal('show');
        }

        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    paginate: {
                        previous: '<i class="ti-angle-left"></i>',
                        next: '<i class="ti-angle-right"></i>'
                    }
                }
            });
        }

        $( "#submit_quote" ).on( "click", function() {
            var n = $( "input:checked[name='quotation_request_id[]" ).length;
            if(n==0){
                $('#quotation_request_error').show();
            }else{
                $('#quotation_request_error').hide();
                $( "#to-quote-form" ).submit();
            }
        });

        $( "#reject" ).on( "click", function() {
            var n = $( "input:checked[name='quotation_request_id[]" ).length;
            if(n==0){
                $('#quotation_request_error').show();
            }else{
                $('#quotation_request_error').hide();
                $('#rejectQuotation').modal('show');
            }
        });

        $( "#cancel" ).on( "click", function() {
            var n = $( "input:checked[name='quotation_request_id[]" ).length;
            if(n==0){
                $('#quotation_request_error').show();
            }else{
                $('#quotation_request_error').hide();
                $('#cancelQuotation').modal('show');
            }
        });

        $( "#submit_cancel" ).on( "click", function() {
            var qr_ids = $( "input:checked[name='quotation_request_id[]" ).map(function(){
                    return $(this).val();
                }).get();

            $('#cancel_qr_id').val(JSON.stringify(qr_ids));
            $( "#cancel_quotation_form" ).submit();
        });

        $( "#submit_add_discount" ).on( "click", function() {
            /*var t1 = $("#t1").val();
            var t2 = $("#t2").val();
            var t3 = $("#t3").val();

            var discountT1 = 1-($("#t1").val()/100);
            var discountT2 = 1-($("#t2").val()/100);
            var discountT3 = 1-($("#t3").val()/100);
            var totalDiscount = 100 - (((100*discountT1)*discountT2)*discountT3);
            totalDiscount = totalDiscount.toFixed(2);

            alert(totalDiscount);*/

            $( "#add_discount_form" ).submit();

            /*if(!reject_reason){
                $('#reject_reason_error').show();
            }else if(reject_reason == 'Others' && !reject_other_reason){
                $('#reject_other_reason_error').show();
            }else{
                $('#reject_reason_error').hide();
                $('#reject_other_reason_error').hide();
                $( "#add_discount_form" ).submit();
            }*/
        });
    </script>
@endsection
