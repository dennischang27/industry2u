@extends('seller.layouts.app')
@section('breadcrumbs')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><span>Products</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
@endsection

@section('content')

    <!-- Table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Products</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <td class="row">{{ ++$i }}</td>
                                    <th scope="row">{{ $product->name }}</td>
                                    <td>{{ $product->detail }}</td>
                                    <td>
                                        <form action="{{ route('seller.products.destroy',$product->id) }}" method="POST">
                                            <a class="btn btn-info" href="{{ route('seller.products.show',$product->id) }}">Show</a>

                                            <a class="btn btn-primary" href="{{ route('seller.products.edit',$product->id) }}">Edit</a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Progress Table end -->

@endsection
