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
                        <li class="breadcrumb-item active"Discount Management</li>
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
                                <h3>Discount Management</h3>
                            </div>
                            <div class="card-body">
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center row-border">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col" data-orderable="false">Discount T1</th>
                                                    <th scope="col" data-orderable="false">Discount T2</th>
                                                    <th scope="col" data-orderable="false">Discount T3</th>
                                                    <th scope="col" data-orderable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                            @foreach ($userlists as $user)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }}</td>
                                                    <td>{{ $user->designation_name }}</td>
                                                    <td>{{ $user->dept_name }}</td>
                                                    <td>{{ $user->discount_tier1 }}</td>
                                                    <td>{{ $user->discount_tier2 }}</td>
                                                    <td>{{ $user->discount_tier3 }}</td>
                                                    <td>
                                                        <a onclick="updateuser({{$user->id}})" class="btn btn-xs btn-primary btn-lg" data-toggle="modal" data-target="#userDetails{{ $user->id }}" style="color: white">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        <input type="hidden" id="test" name="test" value="">
                                                            <div class="modal fade" id="userDetails{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header" style="text-align: left">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body" style="text-align: left">
                                                                    <h6>Name: {{ $user->first_name }} {{ $user->last_name }}</h6>
                                                                    <br />
                                                                    <h6>Date Joined: {{ date('d-m-Y', strtotime($user->created_at)) }}</h6>
                                                                    <br />
                                                                    <h6>Designation: {{ $user->designation_name }} </h6>
                                                                    <br />
                                                                    <h6>Department: {{ $user->dept_name }}</h6>
                                                                    <br />
                                                                    <h6>Email: {{ $user->email }}</h6>
                                                                    <br />
                                                                    <h6>Reporting Manager: {{ ucwords( $user->reporting_fname) }} {{ ucwords($user->reporting_lname) }}</h6>
                                                                    <br />
                                                                    <form method="POST" action="{{route('user.pricemanagement.index')}}">
                                                                        @csrf
                                                            
                                                                        <div class="card-body">
                                                            
                                                                            <div class="row">
                                                            
                                                                                <div class="col-xs-12 col-sm-12 col-md-12">

                                                                                    @if ($errors->any())
                                                                                        <div class="alert alert-danger">
                                                                                            <ul>
                                                                                                @foreach ($errors->all() as $error)
                                                                                                    <li>{{ $error }}</li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                        
                                                                                        <script type="text/javascript">
                                                                                            $( document ).ready(function() {
                                                                                                $('#userDetails').modal('show');
                                                                                            });
                                                                                        </script>
                                                                                    @endif

                                                                                    @if ($user->discount_tier1 != null || $user->discount_tier2 != null || $user->discount_tier3 != null)
                                                                                        <div class="form-group row">
                                                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                                                                                            <div class="col-sm-6">
                                                                                            <input class="form-control" id="discount_tier1" name="discount_tier1" placeholder="discount tier 1" type="number" style="height: 40px" value="{{$user->discount_tier1}}" required> 
                                                                                            </div>
                                                                                            <div style="margin-top: 1%">
                                                                                                <h4>%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                
                                                                                        <div class="form-group row">
                                                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                                                            <div class="col-sm-6">
                                                                                                <input class="form-control" id="discount_tier2" name="discount_tier2" placeholder="discount tier 2" type="number" style="height: 40px" value="{{$user->discount_tier2}}" required>
                                                                                            </div>
                                                                                            <div style="margin-top: 1%">
                                                                                                <h4>%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                
                                                                                        <div class="form-group row">
                                                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                                                            <div class="col-sm-6">
                                                                                                <input class="form-control" id="discount_tier3" name="discount_tier3" placeholder="discount tier 3" type="number" style="height: 40px" value="{{$user->discount_tier3}}" required>
                                                                                            </div>
                                                                                            <div style="margin-top: 1%">
                                                                                                <h4>%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
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
                                                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                                                            <div class="col-sm-6">
                                                                                                <input class="form-control" id="discount_tier2" name="discount_tier2" placeholder="discount tier 2" type="number" style="height: 40px" required>
                                                                                            </div>
                                                                                            <div style="margin-top: 1%">
                                                                                                <h4>%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                
                                                                                        <div class="form-group row">
                                                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                                                            <div class="col-sm-6">
                                                                                                <input class="form-control" id="discount_tier3" name="discount_tier3" placeholder="discount tier 3" type="number" style="height: 40px" required>
                                                                                            </div>
                                                                                            <div style="margin-top: 1%">
                                                                                                <h4>%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                            
                                                                            </div>
                                                                                <input class="form-control" id="user_id" name="user_id" type="hidden" value="{{ $user->id }}">
                                                                                <input class="form-control" id="company_id" name="company_id" type="hidden" value="{{ $user->company_id }}">

                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary btn-sm" id="formSubmit" >Save</button>
                                                                                </div>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    </td>

                                                </tr>
                                            @endforeach
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
                }
            });

    }

    </script>
@endsection
