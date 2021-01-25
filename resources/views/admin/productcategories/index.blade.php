@extends('admin.layouts.app')


@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Categories</h1>
    <!-- End Page Heading -->
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
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
                            <th>id</th>
                            <th>Category Name</th>
                            <th>Parent Category</th>
                            <th>Image</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($productcategories as $productcategory)
                            <tr>
                                <td>{{ $productcategory->id }}</td>

                                <td>{{ $productcategory->name }}</td>
                                <td>
                                    @if($productcategory->parentCategory)
                                        {{ $productcategory->parentCategory->name }}
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    @if(isset($productcategory->image))
                                        <img src="{{ asset('storage/categories/'.$productcategory->image) }}" width="60" height="60">
                                    @else
                                        <img src=" {{ asset('images/noimage.jpg') }}" width="60" height="60">
                                    @endif
                                </td>
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
