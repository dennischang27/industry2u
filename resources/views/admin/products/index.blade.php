@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!-- End Page Heading -->
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
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Series No</th>
                    <th>Company Name</th>
                    <th>Supplier Name</th>
                    <th width="280px">Action</th>
                </tr>
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
            </table>
            {!! $products->links() !!}
        </div>
    </div>
@endsection
