@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Centre</b>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                Home
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Products Managenent</li>
                        <li class="breadcrumb-item active">My Products</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_style')
    <link href="{{ asset('assets/datatables/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/datatables/css/responsive.jqueryui.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>My Products</h3>
                            </div>
                            <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_script')

    <script src="{{ asset('assets/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/js/responsive.bootstrap.min.js') }}"></script>

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