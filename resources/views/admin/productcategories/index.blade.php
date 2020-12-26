@extends('admin.layouts.app')


@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Categories</h1>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.productcategories.create') }}"> Create New Category</a>
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
                            <th>Slug</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($productcategories as $productcategory)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $productcategory->name }}</td>
                                <td>{{ $productcategory->slug }}</td>
                                <td>
                                    <form action="{{ route('admin.productcategories.destroy',$productcategory->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('admin.productcategories.show',$productcategory->id) }}">Show</a>

                                            <a class="btn btn-primary" href="{{ route('admin.productcategories.edit',$productcategory->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
    {!! $productcategories->links() !!}
    </div>
@endsection
