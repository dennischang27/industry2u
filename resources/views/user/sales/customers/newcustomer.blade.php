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
                        <li class="breadcrumb-item active">New Customer</li>
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
                                <h3>New Customer</h3>
                                
                            </div>
                            <div class="card-body">

                <div class="single-table">
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr style="font-size: 11px">
                                    <th scope="col">No</th>
                                    <th scope="col">Requested Date</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Quotation Request No</th>
                                    <th scope="col">Sales Executive</th>
                                    <th scope="col" data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px">
                                @foreach ($newCustomer as $customer)
                                <tr>
                                    <td>{{ ++$i}}</td>
                                    <td>{{ date('d-m-Y', strtotime($customer->created_at)) }} </td>
                                    <td>{{ ucwords($customer->company_name) }}</td>
                                    <td>{{ $customer->qr_no }} </td>
                                    <td></td>
                                    <td>
                                        <a class="btn  btn-xs btn-primary btn-lg" data-toggle="modal" data-target="#yourModal{{$customer->id}}" style="color: white">
                                            <i class="ti-pencil"></i>
                                        </a>
                                            <div class="modal fade" id="yourModal{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('user.customermanagement.newcustomerassign') }}">
                                                        @csrf
                                                  <div class="modal-header" style="text-align: left">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                    </h4>
                                                  </div>
                                                  <div class="modal-body" style="text-align: left">
                                                    <h6>Customer:  {{ ucwords($customer->company_name) }}</h6>
                                                    <br />
                                                    
                                                    <h6>Requested Date: {{ date('d-m-Y', strtotime($customer->created_at)) }}</h6>
                                                    <br />

                                                    <input type="hidden" name="purchaser_id" value="{{$customer->purchaser_id}}"/>
                                                    <input type="hidden" name="id" value="{{$customer->id}}"/>

                                                    <h6>Sales Executive:</h6>
                                                    
                                                    <select class="form-control" name="sales_ex_id">
                                                        <option selected disabled>Select Sales Executive</option>
                                                        @foreach ($salesExs as $saleExs)
                                                            <option value="{{ $saleExs->user_id }}">
                                                                {{ ucwords($saleExs->first_name) }} {{ ucwords($saleExs->last_name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                                  </div>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                    </td>

                                </tr>
                                @endforeach

                              
                                

                            {{-- @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->name }}</td>
                                    <td>@if($product->category->parentCategory)
                                            {{ $product->category->parentCategory->name }} >
                                        @endif
                                        {{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>
                                            <a class="btn  btn-xs btn-info" href="{{ route('seller.products.show',$product->id) }}">Show</a>

                                            <a class="btn  btn-xs btn-primary" href="{{ route('seller.products.edit',$product->id) }}">Edit</a>


                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteproduct{{ $product->id }}">Delete</button>
                                            <div id="deleteproduct{{ $product->id }}" class="delete-modal modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="delete-icon"></div>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                            <p>Do you really want to delete this product? This process cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{route('seller.products.destroy',$product->id)}}" class="pull-right">
                                                                {{csrf_field()}}
                                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
        
    <!-- Progress Table end -->

                              
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
            });
    }


       
    </script>
@endsection
