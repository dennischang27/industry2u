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
                                Quotation
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
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
        .btn-fill-out {
            border: 0.5px solid var(--color-1st);
        }
        #submit_reject{
            margin-top:30px;
        }
        .card-body p {
            margin-bottom: 0px;
            line-height: 20px;
        }
    </style>
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
                                    <form id="to-quote-form" class="form--shopping-cart" method="post" action="{{ route("buyer.quotationrequest") }}">
                                    @csrf
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th></th>
                                                    <th><input type="checkbox" class="checked_all"></th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Quotation Request No</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Requested By</th>
                                                    <th scope="col">Status</th>
                                                    @hasanyrole('Purchasing Moderator|Purchasing Manager|Purchasing Executive')
                                                        <th scope="col">Remark</th>
                                                    @endhasanyrole
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                @if($quotation_requests)
                                                    @foreach ($quotation_requests as $quotation_request)
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            @if($quotation_request->status == "Request Quotation")
                                                                <input id='quotation_request_id[]' name='quotation_request_id[]' type="checkbox" class="checkbox" value="{{$quotation_request->id}}">
                                                            @else
                                                                <input disabled id='quotation_request_id[]' name='quotation_request_id[]' type="checkbox" class="checkbox" value="{{$quotation_request->id}}">
                                                            @endif
                                                        </td>
                                                        <td>{{date('d/m/Y', strtotime($quotation_request->updated_at))}}</td>
                                                        <td><a href="javascript:viewQuotationRequest({{$quotation_request->id}})">{{$quotation_request->qr_no}}</a></td>
                                                        <td>{{$quotation_request->supplier_company_name}}</td>
                                                        <td>{{$quotation_request->requestBy->first_name}}{{$quotation_request->requestBy->last_name}}</td>
                                                        <td>{{$quotation_request->status}}</td>
                                                        @hasanyrole('Purchasing Moderator|Purchasing Manager|Purchasing Executive')
                                                            <td>{{$quotation_request->remark}}</td>
                                                        @endhasanyrole
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
                                                                            <p>Email: <span id="supplier_email"></span></p>
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
                                                                            <p>Valid Until: <span id="quotation_valid_until"></span></p>
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
                                        <div class="modal fade" id="rejectQuotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="text-align: left">
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            Reject Quotation Request
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left">
                                                        <form id="reject_quotation_form" method="POST" action="{{route('buyer.rejectquotationrequest')}}">
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
                                                                                <option value="Quotation has been requested">Quotation has been requested</option>
                                                                                <option value="Others">Others</option>
                                                                            </select>
                                                                            <span id="reject_reason_error" class="invalid-feedback text-danger" role="alert">
                                                                                <strong>Please select reject reason</strong>
                                                                            </span>
                                                                            </div>
                                                                        </div>
                                                                        <div id="other_reason" class="form-group row" style="display: none;">
                                                                            <label for="reject_other_reason" class="col-sm-12 col-form-label"><strong>Enter Other Reasons:</strong><small class="text-danger">*</small></label>
                                                                            <div class="col-sm-12">
                                                                            <input class="form-control" id="reject_other_reason" name="reject_other_reason" placeholder="reject other reasons" type="text" style="height: 40px" value="" required>
                                                                            <span id="reject_other_reason_error" class="invalid-feedback text-danger" role="alert">
                                                                                <strong>Please enter reject reason</strong>
                                                                            </span> 
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" id="qr_id" name="qr_id" value=''>
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
                $("#supplier_email").text("missing email");
                
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
                                        '<div class="col-sm-2 text-left"> PCS</div>';

                    $( "#product_list" ).append(product_html);
                    i++;
                }); 
                $('#viewQuotationRequest').modal('show');
            }
        });
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
    $('.checked_all').on('change', function() {     
        $('.checkbox').not(":disabled").prop('checked', $(this).prop("checked"));    
    });
    
    //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked    
    $('.checkbox').change(function(){ //".checkbox" change 
        if($('.checkbox:checked').length == $('.checkbox').length){
                $('.checked_all').prop('checked',true);
        }else{
                $('.checked_all').prop('checked',false);
        }
    });

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

    $( "#submit_reject" ).on( "click", function() {
        var reject_reason = $( "#reject_reason" ).val();
        var reject_other_reason = $( "#reject_other_reason" ).val();

        if(!reject_reason){
            $('#reject_reason_error').show();
        }else if(reject_reason == 'Others' && !reject_other_reason){
            $('#reject_other_reason_error').show();
        }else{
            $('#reject_reason_error').hide();
            $('#reject_other_reason_error').hide();

            var qr_ids = $( "input:checked[name='quotation_request_id[]" ).map(function(){
                return $(this).val();
            }).get();

            $('#qr_id').val(JSON.stringify(qr_ids));
            $( "#reject_quotation_form" ).submit();
        }
    });

    $( "#reject_reason" ).change(function() {
        var value = $(this).val();
        if(value == 'Others'){
            $('#other_reason').show();
        }else{
            $('#other_reason').hide();
        }
    });
    </script>
@endsection
