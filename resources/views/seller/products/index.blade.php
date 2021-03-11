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

@section('plugin_style')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('content')

    <!-- Table start -->
    <div class="col-12 mt-5">
        <div class="card">

            <div class="card-body">
                <h4 class="header-title">Products</h4>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        @if ($product_link = Session::get('product_link'))
                            <a href="{{ $product_link }}" target="_blank">View</a>
                        @endif
                    </div>
                @endif
                <div class="single-table">
                    <div class="data-tables">
                        <table class="text-center yajra-datatable">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">category</th>
                                    <th scope="col">brand</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Progress Table end -->

@endsection

@section('plugin_script')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('seller.products.getproducts') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category_name', name: 'product_categories.name'},
                    {data: 'brand_name', name: 'brands.name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });

        });
    </script>
@endsection
