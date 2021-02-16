@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Companies Management</h1>
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
            <div class="table-responsive">
                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Reg. No</th>
                        <th>Admin</th>
                        <th>address</th>
                        <th>Is Buyer</th>
                        <th>Is Seller</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($data as $key => $company)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->reg_no }}</td>
                            <td>{{ $company->adminUser->first_name }}</td>
                            <td>{{ $company->street }}, {{ $company->postal_code }}, {{ $company->city }}, {{ $company->state->name }}</td>
                            <td>{{ ($company->is_buyer? 'yes' : 'no')  }}</td>
                            <td>{{ ($company->is_seller? 'yes' : 'no')  }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.companies.show',$company->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('admin.companies.edit',$company->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $data->render() !!}
            </div>
        </div>
    </div>
@endsection
