@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Brands</h1>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
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
                        <th>Description</th>
                        <th>Logo</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>
                                @if(isset($brand->logo))
                                    <img src="{{ asset('storage/brands/'.$brand->logo) }}" width="60" height="60">
                                @else
                                    <img src=" {{ asset('images/noimage.jpg') }}" width="60" height="60">
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.brands.show',$brand->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('admin.brands.edit',$brand->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletebrand{{ $brand->id }}">Delete</button>
                                <div id="deletebrand{{ $brand->id }}" class="delete-modal modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="delete-icon"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h4 class="modal-heading">Are You Sure ?</h4>
                                                <p>Do you really want to delete this brand? This process cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="{{route('admin.brands.destroy',$brand->id)}}" class="pull-right">
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
                </table>
                @foreach ($brands as $brand)


                @endforeach
            {!! $brands->links() !!}
        </div>
@endsection

