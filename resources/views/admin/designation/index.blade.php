@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Designation Management</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.users.designation.create') }}"> Create New Designation</a>
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
                        <th>Designation</th>
                        <th>Department</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($designations as $key => $designation)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $designation->name }}</td>
                            <td>{{ $designation->role_name  }}</td>
                            <td>
                                <!--<a class="btn btn-info" href="{{ route('admin.users.designation.show',$designation->id) }}">Show</a>-->
                                <a class="btn btn-primary" href="{{ route('admin.users.designation.edit',$designation->id) }}">Edit</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.users.designation.destroy', $designation->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $designations->render() !!}
            </div>
        </div>
    </div>
@endsection
