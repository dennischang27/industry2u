@extends('admin.layouts.app')


@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Attributes</h1>
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
                            <th>id</th>
                            <th>Attribute Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($attributemeasurements as $attributemeasurement)
                            <tr>
                                <td>{{ $attributemeasurement->id }}</td>

                                <td>{{ $attributemeasurement->name }}</td>
                                <td>
                                   <a class="btn btn-primary" href="{{ route('admin.ecommerce.attributemeasurements.edit',$attributemeasurement->id) }}">Edit</a>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
    {!! $attributemeasurements->links() !!}
    </div>
@endsection
