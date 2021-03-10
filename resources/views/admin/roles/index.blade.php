@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Roles Management</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.users.roles.create') }}"> Create New Role</a>
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
                        <th>Buyer</th>
                        <th>Seller</th>
						<th>Department</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{  ($role->is_buyer? 'yes' : 'no')  }}</td>
                            <td>{{ ($role->is_seller? 'yes' : 'no')  }}</td>
							<td>{{ $role->department_name  }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.users.roles.show',$role->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('admin.users.roles.edit',$role->id) }}">Edit</a>
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.users.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $roles->render() !!}
            </div>
        </div>
    </div>
@endsection
