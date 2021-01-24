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
        @error('uploaded_file')
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        @if(session('product_process'))
            <div class='row'>
                <i class="col-12">{{ session('product_process')->successCount }} product(s) are uploaded</i>
            </div>

            <div class='row'>
                <i class="col-12">{{ session('product_process')->skipCount }} product(s) are skipped</i>
            </div>

            @if(session('product_process')->skipCount > 0)
                <div class='row'>
                    <i class="col-12">skip reason(s):</i>
                    <ul>
                        @foreach(session('product_process')->skipSummary as $reason => $flag)
                            <li>{{ $reason }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Bulk product upload</h4>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><strong>Product List Excel Template :</strong></label>
                        <div class="col-sm-9">
                            <a target="_blank" href="{{ route("seller.products.template.download") }}">
                                Download
                            </a>
                        </div>
                    </div>
                    <form action="{{route('seller.products.template.upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-4">
                            <input class="form-control " id="uploaded_file" accept=".xls, .xlsx" type="file" value="{{@old('uploaded_file')}}" name="uploaded_file" required="" autofocus="">
                            </div>
                            <div class="col-4">
                                <input class="btn btn-primary" type="submit" value="Upload">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Products</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Series No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->name }}</td>
                                    <td>{{ $product->series_no }}</td>
                                    <td>@if($product->category->parentCategory)
                                            {{ $product->category->parentCategory->name }} >
                                        @endif
                                        {{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>
                                            <a class="btn btn-info" href="{{ route('seller.products.show',$product->id) }}">Show</a>

                                            <a class="btn btn-primary" href="{{ route('seller.products.edit',$product->id) }}">Edit</a>


                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteproduct{{ $product->id }}">Delete</button>
                                            <div id="deleteproduct{{ $product->id }}" class="delete-modal modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="delete-icon"></div>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                            <p>Do you really want to delete this product? This process cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{route('seller.products.destroy',$product->id)}}" class="pull-right">
                                                                {{csrf_field()}}
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
