@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users Management</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.users.users.create') }}"> Create New User</a>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Is Buyer</th>
                        <th>Is Seller</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ ($user->is_buyer? 'yes' : 'no')  }}</td>
                            <td>{{ ($user->is_seller? 'yes' : 'no')  }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.users.users.show',$user->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('admin.users.users.edit',$user->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $data->render() !!}
            </div>
        </div>
    </div>
@endsection
