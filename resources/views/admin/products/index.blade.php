@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!-- End Page Heading -->
@endsection

@section('style')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">

            </div>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="data-tables datatable-primary">
            <table id="dataTable" class="table table-bordered">
                <thead class="bg-light text-capitalize">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Series No</th>
                    <th>Company Name</th>
                    <th>Supplier Name</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->series_no }}</td>
                        <td>{{ $product->company->name }}</td>
                        <td>{{ $product->user->first_name }}</td>
                        <td>
                            <form action="{{ route('admin.ecommerce.products.destroy',$product->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('admin.ecommerce.products.show',$product->id) }}">Show</a>
                                @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('admin.ecommerce.products.edit',$product->id) }}">Edit</a>
                                @endcan
                                @csrf
                                @method('DELETE')
                                @can('admin.product-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            {!! $products->links() !!}
        </div>
    </div>
@endsection

@section('script')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

@endsection
