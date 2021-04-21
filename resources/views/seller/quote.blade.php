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
        #submit_reject{
            margin-top:30px;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before{
            
        }
        .btn-custom{
            border-radius: .25rem;
        }
        .card-body p {
            margin-bottom: 0px;
            line-height: 20px;
        }
        .btn-disable{
            padding: 5px 10px;
            font-size: 11px;
        }
        .btn-reject{
            padding: 5px 10px;
            font-size: 11px;
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
                                <h3>To Quote</h3>
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
                                    <form id="quote-issue-form" class="form--shopping-cart" method="post" action="{{ route("seller.quotationissue") }}">
                                    @csrf
                                        <input type="hidden" id="qr_id" name="qr_id" value="">
                                    </form>
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th>No</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Quotation Request No</th>
                                                    <th scope="col">Quotation Status</th>
                                                    <th scope="col">Remark</th>
                                                    <th scope="col">Payment Term</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                @if($quotation_requests)
                                                    @foreach ($quotation_requests as $quotation_request)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{date('d/m/Y', strtotime($quotation_request->updated_at))}}</td>
                                                        <td>{{$quotation_request->customerCompany->name}}</td>
                                                        <!--<td><a href="javascript:viewQuotationRequest({{$quotation_request->id}})">{{$quotation_request->qr_no}}</a></td>-->
                                                        <td><a href="{{ route('buyer.quotationrequestview',['qr_id'=>$quotation_request->id]) }}">{{$quotation_request->qr_no}}</a></td>
                                                        <td>{{$quotation_request->status}}</td>
                                                        <td>{{$quotation_request->remark}}</td>
                                                        <td>{{$quotation_request->payment_term_code}}</td>
                                                        <td>
                                                        <button type="button" onclick="term({{$quotation_request->id}}, {{$quotation_request->payment_term_days}})" class="btn-custom btn-fill-out-green" id="term" name="term">Term</button>
                                                            @if($quotation_request->status=="Pending Approval")
                                                                @if($user_id==$quotation_request->approve_by)
                                                                    <button type="button" onclick="issue({{$quotation_request->id}})" class="btn-custom btn-reject btn-fill-out-green" id="issue_quote" name="issue_quote">Approve</button>
                                                                    <button type="button" onclick="rejectApproval({{$quotation_request->id}})" class="btn btn-reject btn-fill-out-red" id="reject" name="reject">Reject</button>
                                                                @else 
                                                                    <button type="button" class="btn btn-disable btn-secondary" disabled>Quote</button>
                                                                    <button type="button" class="btn btn-disable btn-secondary" disabled>Submit</button>
                                                                @endif
                                                            @else
                                                                <button type="button" onclick="view({{$quotation_request->id}})" class="btn-custom btn-fill-out-green" id="quote" name="quote">Quote</button>
                                                                <button type="button" onclick="issue({{$quotation_request->id}})" class="btn-custom btn-fill-out" id="issue_quote" name="issue_quote">Submit</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal fade" id="viewQuotationRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: left">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br/>
                                                <form id="cancel_quotation_form" method="POST" action="{{route('buyer.cancelquotationrequest')}}">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-2.5 text-left">
                                                                    <img id="company_image" src="" width="120" height="120">
                                                                </div>
                                                                <div class="col-sm-6 text-left">
                                                                    <h4 id="purchaser_company"></h4>
                                                                    <h6>(reg no: <span id="supplier_reg_no"></span>)</h6>
                                                                </div>
                                                                <div class="col-sm-4 text-right">
                                                                    <p id="supplier_street"></p>
                                                                    <p><span id="supplier_postal_code"></span>, <span id="supplier_city"></span></p>
                                                                    <p><span id="supplier_state"></span> <span id="supplier_country"></span></p><br/>
                                                                    <p>Tel: <span id="supplier_phone"></span></p>
                                                                    <!--<p>Email: <span id="supplier_email"></span></p>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-6 text-left">
                                                                    To: <span id="purchaser_company_name"></span>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <h3>Quotation Request</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6 text-left">
                                                                    <p><b>Billing Address</b></p>
                                                                    <p id="purchaser_address"></p>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <p>No: <span id="quotation_no"></span></p>
                                                                    <p>Date: <span id="created_at"></span></p>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div class="row">
                                                                <div class="col-sm-6 text-left">
                                                                    <p>ATTN: <span id="purchaser_name"></span></p>
                                                                    <p>Tel: <span id="purchaser_phone"></span></p>
                                                                    <p>Email: <span id="purchaser_email"></span></p>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <!--<p>Valid Until: <span id="quotation_valid_until"></span></p>-->
                                                                    <!--<p>Delivery: </p>-->
                                                                    <p>Term: COD</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-8 text-left">
                                                                    <b>DESCRIPTION</b>
                                                                </div>
                                                                <div class="col-sm-2 text-left">
                                                                    <b>QTY</b>
                                                                </div>
                                                                <div class="col-sm-2 text-left">
                                                                    <b>UOM</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div id="product_list" class="container">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="term_form" method="POST" action="{{route('seller.quote.term')}}">
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
                                                        <select title="Please select reject reason" required name="payment_term"
                                                                class="@error('payment_term') is-invalid @enderror form-control select2" id="payment_term">
                                                            <option value="">Please select payment term</option>
                                                            @foreach($terms as $term)
                                                                <option value="{{$term->days}}"/> {{$term->code}} </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="payment_term_error" class="invalid-feedback text-danger" role="alert">
                                                            <strong>Please select payment term</strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="term_qr_id" name="term_qr_id" value=''>
                                                    <input type="hidden" id="term_code" name="term_code" value=''>
                                                    <div class="col text-center">
                                                        <button type="button" class="btn btn-fill-out" id="submit_term" name="submit_term">Submit</button>
                                                    </div>
                                                </div>
                                            </from>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="rejectQuotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="text-align: left">
                                                <h4 class="modal-title" id="myModalLabel">
                                                    Reject Quotation
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" style="text-align: left">
                                                <form id="reject_quotation_form" method="POST" action="{{route('seller.quote.reject')}}">
                                                @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group row">
                                                                    <label for="reject_reason" class="col-sm-12 col-form-label"><strong>Enter Reject Reason:</strong><small class="text-danger">*</small></label>
                                                                    <div class="col-sm-12">
                                                                    <select title="Please select reject reason" required name="reject_reason"
                                                                            class="@error('reject_reason') is-invalid @enderror form-control select2" id="reject_reason">
                                                                        <option value="">Please select reject reason</option>
                                                                        <option value="Out of Stock">Out of Stock</option>
                                                                        <option value="Discount Rate">Discount Rate</option>
                                                                    </select>
                                                                    <span id="reject_reason_error" class="invalid-feedback text-danger" role="alert">
                                                                        <strong>Please select reject reason</strong>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                                <div id="other_reason" class="form-group row" style="display: none;">
                                                                    <label for="discount_rate" class="col-sm-12 col-form-label"><strong>Enter Discount Rate:</strong><small class="text-danger">*</small></label>
                                                                    <div class="col-sm-12">
                                                                    <input class="form-control" id="discount_rate" name="discount_rate" placeholder="discount rate" type="text" style="height: 40px" value="" required>
                                                                    <span id="discount_rate_error" class="invalid-feedback text-danger" role="alert">
                                                                        <strong>Please enter discount rate</strong>
                                                                    </span> 
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="qr_approve_id" name="qr_approve_id" value=''>
                                                                <div class="col text-center">
                                                                    <button type="button" class="btn btn-fill-out" id="submit_reject" name="submit_reject">Submit</button>
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
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/responsive.bootstrap.min.js') }}"></script>
    <script>

        function view(qr_id){
            window.location.href = "quote/"+qr_id+"/details";
        }

        function issue(qr_id){
            $( "#qr_id" ).val(qr_id);
            $( "#quote-issue-form" ).submit();
        }

        function term(qr_id, payment_term_days){
            $("#term_qr_id").val(qr_id);
            $("#payment_term").val(payment_term_days);
            $('#termModal').modal('show');
        }

        $( "#payment_term" ).change(function() {
            var value = $(this).find("option:selected").text();
            $("#term_code").val(value);
        });

        $( "#submit_term" ).on( "click", function() {
            $( "#term_form" ).submit();
        });

        function GetFormattedDate(datetime) {
            newdatetime = new Date(datetime);
            var month = newdatetime.getMonth() + 1;
            var day = newdatetime.getDate();
            var year = newdatetime.getFullYear().toString().substr(-2);
            return day + "/" + month + "/" + year;
        }

        function viewQuotationRequest(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                data: {qr_id: id},
                url: '{{route('buyer.quote.request.file')}}',
                success : function(data){
                    $("#company_image").attr("src", "{{url('storage')}}/"+data.logo);
                    $("#purchaser_company").text(data.purchaser_company_name);
                    $("#supplier_reg_no").text(data.purchaser_reg_no);
                    $("#supplier_street").text(data.purchaser_street);
                    $("#supplier_postal_code").text(data.purchaser_postal_code);
                    $("#supplier_city").text(data.purchaser_city);
                    $("#supplier_state").text(data.purchaser_state_id);
                    $("#supplier_country").text(data.purchaser_country);
                    $("#supplier_phone").text(data.purchaser_phone);
                    //$("#supplier_email").text("missing email");
                    
                    $("#purchaser_company_name").text(data.supplier_company_name);
                    var purchaser_address = data.supplier_street + ", " + data.supplier_postal_code + " " + data.supplier_city  + ", " + 
                                    data.supplier_state_id + ", " + data.supplier_country;
                    $("#purchaser_address").text(purchaser_address);
                    $("#quotation_no ").text(data.qr_no);
                    $("#created_at").text(GetFormattedDate(data.created_at));
                    
                    var purchaser_name = data.first_name + " " + data.last_name;
                    $("#purchaser_name").text(purchaser_name);
                    $("#purchaser_phone").text(data.user_phone);
                    $("#purchaser_email").text(data.user_email);
                    $("#quotation_valid_until").text(GetFormattedDate(data.qr_valid_until));
                }
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                data: {qr_id: id},
                url: '{{route('buyer.quote.request.file.products')}}',
                success : function(data){
                    $( "#product_list" ).text('');
                    var i = 1;
                    $.each(data, function(key,value) {
                        var product_html = '<div class="row"><div class="col-sm-8 text-left">'+i+'. '+value.product_name+'</div>' +
                                            '<div class="col-sm-2 text-left">'+value.quantity+'</div>' +
                                            '<div class="col-sm-2 text-left"> PCS</div></div>';

                            product_html = product_html + '<div class="row"><div class="col-sm-8 ml-3 text-left">series no: '+value.series_no+'</div>' +
                                            '<div class="col-sm-2 text-left"></div>'+
                                            '<div class="col-sm-2 text-left"></div></div>';

                            product_html = product_html + '<div class="row"><div class="col-sm-8 ml-3 text-left">category : '+value.category_name+'</div>' +
                                            '<div class="col-sm-2 text-left"></div>'+
                                            '<div class="col-sm-2 text-left"></div></div>';

                        $( "#product_list" ).append(product_html);
                        i++;
                    }); 
                    $('#viewQuotationRequest').modal('show');
                }
            });
        }

        function rejectApproval(qr_id){
            $("#qr_approve_id").val(qr_id);
            $('#rejectQuotation').modal('show');
        }

        $( "#submit_reject" ).on( "click", function() {
            var reject_reason = $( "#reject_reason" ).val();
            var discount_rate = $( "#discount_rate" ).val();

            if(!reject_reason){
                $('#reject_reason_error').show();
            }else if(reject_reason == 'Discount Rate' && !discount_rate){
                $('#discount_rate_error').show();
            }else{
                $('#reject_reason_error').hide();
                $('#discount_rate_error').hide();
                $( "#reject_quotation_form" ).submit();
            }
        });

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

        $( "#reject_reason" ).change(function() {
            var value = $(this).val();
            if(value == 'Discount Rate'){
                $('#other_reason').show();
            }else{
                $('#other_reason').hide();
            }
        });
    </script>
@endsection
