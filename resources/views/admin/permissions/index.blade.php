@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Permissions Management</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.users.permissions.create') }}"> Create New Permission</a>
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
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.users.permissions.show',$permission->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('admin.users.permissions.edit',$permission->id) }}">Edit</a>
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.users.permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $permissions->render() !!}
            </div>
        </div>
    </div>
@endsection
