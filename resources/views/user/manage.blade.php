@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Management Center</b>
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
                        <li class="breadcrumb-item active">Manage Users</li>
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
    </style>
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.managementsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Manage Users</h3>
                                
                            </div>
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Date Joined</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">User Designation</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" data-orderable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 11px">
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{date('d/m/Y', strtotime($user->updated_at))}}</td>
                                                    <td>{{$user->first_name}}</td>
                                                    <td>{{$user->last_name}}</td>
                                                    <td>{{$user->designationName->name}}</td>
                                                    <td>{{$user->departmentName->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->status}}</td>
                                                    <td>
                                                        @if($user->status == 'active')
                                                        <a class="btn btn-xs btn-info" style="color: white" href="{{route('user.manage.edit', $user)}}">
                                                            Edit
                                                        </a>
                                                        @endif
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
    </script>
@endsection
