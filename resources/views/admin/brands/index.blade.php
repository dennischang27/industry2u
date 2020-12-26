@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Brands</h1>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.brands.create') }}"> Create New Brand</a>
            </div>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Descriptions</th>
                        <th>Logo</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->descriptions }}</td>
                            <td>
                                <img src="{{ asset('images/no-image.png') }}" width="100" height="100">
                            </td>
                            <td>
                                <form action="{{ route('admin.brands.destroy',$brand->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('admin.brands.show',$brand->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('admin.brands.edit',$brand->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {!! $brands->links() !!}
        </div>
@endsection
