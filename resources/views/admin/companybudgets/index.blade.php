@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Company Budget Ranges</h1>
@endsection

@section('style')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.1em 0.1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #333 !important;
            border: 1px solid transparent;
            border-radius: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.settings.companybudget.create') }}"> Create New Budget Range</a>
            </div>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="single-table">
             <div class="data-tables">
                <table class="text-center"  id="dataTable" cellspacing="0">
                    <thead class="bg-light text-capitalize">
                    <tr>
                        <th>Name</th>
                        <th>From</th>
                        <th>To</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companybudgets as $companybudget)
                        <tr>
                            <td class="text-left">{{ $companybudget->name }}</td>
                            <td class="text-left">{{ $companybudget->from }}</td>
                            <td class="text-left">{{ $companybudget->to }}</td>
                            <td>
                                    <a class="btn btn-primary" href="{{ route('admin.settings.companybudget.edit',$companybudget->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletecompanybudget{{ $companybudget->id }}">Delete</button>
                                <div id="deletecompanybudget{{ $companybudget->id }}" class="delete-modal modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="delete-icon"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h4 class="modal-heading">Are You Sure ?</h4>
                                                <p>Do you really want to delete this budget range? This process cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="{{route('admin.settings.companybudget.destroy',$companybudget->id)}}" class="pull-right">
                                                    {{csrf_field()}}
                                                    {{method_field("DELETE")}}

                                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
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
@endsection


@section('plugin_script')
    <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        <script>
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    responsive: false
                });
            }
        </script>
@endsection
