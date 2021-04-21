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

@section('plugin_style')
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
                                <h3>Manage Product (By Category)</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <div id="alertMsg">
                                        
                                    </div>
                                    <br />
                                </div>
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center row-border">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col" data-orderable="false">Discount T1</th>
                                                    <th scope="col" data-orderable="false">Discount T2</th>
                                                    <th scope="col" data-orderable="false">Discount T3</th>
                                                    <th scope="col" data-orderable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">                                                
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ ucwords($category->name) }}</td>
                                                    <td>{{ $category->discount_tier1 }}</td>
                                                    <td>{{ $category->discount_tier2 }}</td>
                                                    <td>{{ $category->discount_tier3 }}</td>
                                                    <td>
                                                        <a class="btn btn-xs btn-primary btn-lg" 
                                                         onclick="categoryDiscountModal('{{ ucwords($category->name) }}',  @if($category->discount_tier1) {{$category->discount_tier1}} @else 0 @endif, @if($category->discount_tier2) {{$category->discount_tier2}} @else 0 @endif, @if($category->discount_tier3) {{$category->discount_tier3}} @else 0 @endif, {{ $category->parent_id }},  {{$customer}}, {{ $totalDiscount }}, {{ $category->total_discount }} )" 
                                                         style="color:white;">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                            
                                                    </td>

                                                </tr>
                                            @endforeach
                                            
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="categoryDiscount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header" style="text-align: left">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                    </h4>
                                                </div>
                                                <div class="modal-body" style="text-align: left">
                                                                                              
                                                    <div class="card-body">

                                                        <h6>Category Name: <span id="name"></span></h6>
                                                        <br />
                                            
                                                        <form method="POST" name="DiscountForm" action="{{route('user.customermanagement.mycustomer.managebycategory', $customer)}}">
                                                            @csrf
                                                            <div class="row">
                                                
                                                                <div class="col-xs-12 col-sm-12 col-md-12">

                                                                    <div class="form-group row">
                                                                        <div id="errorMsg">
                                                                        </div>
                                                                    </div>
                                                                    <br />
                                                                        
                                                                    <div class="form-group row">
                                                                        <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                                                                        <div class="col-sm-6">
                                                                        <input class="form-control" id="discount_tier1" name="discount_tier1" placeholder="discount tier 1" type="number" style="height: 40px" required> 
                                                                        </div>
                                                                        <div style="margin-top: 1%">
                                                                            <h4>%</h4>
                                                                        </div>
                                                                    </div>
                                                
                                                                    <div class="form-group row">
                                                                        <label for="discount_tier2" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control" id="discount_tier2" name="discount_tier2" placeholder="discount tier 2" type="number" style="height: 40px" required>
                                                                        </div>
                                                                        <div style="margin-top: 1%">
                                                                            <h4>%</h4>
                                                                        </div>
                                                                    </div>
                                                
                                                                    <div class="form-group row">
                                                                        <label for="discount_tier3" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control" id="discount_tier3" name="discount_tier3" placeholder="discount tier 3" type="number" style="height: 40px" required>
                                                                        </div>
                                                                        <div style="margin-top: 1%">
                                                                            <h4>%</h4>
                                                                        </div>
                                                                    </div>
                                                                        <br>
                                                                        {{-- <p>parent id</p> --}}
                                                                        <input class="form-control" type="hidden" id="parent_id" name="parent_id" value="">
                                                                        {{-- <p>master discount</p> --}}
                                                                        <input class="form-control" type="hidden" id="totalDiscountMaster" name="totalDiscount" value="" >
                                                                        {{-- <p>existing discount</p> --}}
                                                                        <input class="form-control" type="hidden" id="totalDiscountExisting" name="total_discount" value="{{ $category->total_discount }}">
                                                                        <input class="form-control" type="hidden" id="customer_company_id" name="customer_company_id" value="{{ $customer }}">

                                                                       
                                                                </div>
                                                
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btn-sm" id="formSubmit"  onclick="validateForm()">Save</button>
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


@section('plugin_script')
<script src="{{asset('assets/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/datatables/js/responsive.bootstrap.min.js')}}"></script>


    <script>
        function getSearchParams(k){
            var p={};
            location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
            return k?p[k]:p;
        }

        $( document ).ready(function() {
            if(getSearchParams("success")){
                $("#alertMsg").html('<span id="alertMsg" class="alert alert-success">Discount Settings updated successfully</span>.');
            }

            window.setTimeout(function(){
                $("#alertMsg").html("");
            }, 2500);

        });

        if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    responsive: false,
                    language: {
                        paginate: {
                            next: '>', // or '→'
                            previous: '<' // or '←' 
                        }
                    }
                });
        }


    function categoryDiscountModal(name, discount_tier1, discount_tier2, discount_tier3, parent_id, customer_company_id, totalDiscountMaster, totalDiscountExisting,  ){
      
        $("#name").text(name);
        $("#parent_id").val(parent_id);
        $('#customer_company_id').val(customer_company_id);

        $('#discount_tier1').val(discount_tier1);
        $('#discount_tier2').val(discount_tier2);
        $('#discount_tier3').val(discount_tier3);

        $('#totalDiscountMaster').val(totalDiscountMaster);
        $('#totalDiscountExisting').val(totalDiscountExisting);
        $("#categoryDiscount").modal('show');

    }

    function validateForm() {

        var discount_tier1 = $('#discount_tier1').val();
        var discount_tier2 = $('#discount_tier2').val();
        var discount_tier3 = $('#discount_tier3').val();

        var discountT1 = 1-(discount_tier1/100);
        var discountT2 = 1-(discount_tier2/100);
        var discountT3 = 1-(discount_tier3/100);

        var parent_id = $('#parent_id').val();

        var customer_company_id = $('#customer_company_id').val();

        var totalDiscount = 100 - (((100*discountT1)*discountT2)*discountT3);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            data : {discount_tier1: discount_tier1, discount_tier2:discount_tier2, discount_tier3: discount_tier3, parent_id:parent_id, customer_company_id:customer_company_id},
            url  : '{{route("user.customermanagement.mycustomer.managebycategorystore")}}',
            success : function(data){
                console.log(data);
               if(data=="total discount exceed limit"){

                    $("#errorMsg").html('<span id="errorMsg" class="alert alert-danger">Total Discount Exceed Limit</span>.');

                }else{
                    window.location.href = window.location.href.split('?')[0] + "?success=true";
                }


            }
        });

    }

    </script>
@endsection
