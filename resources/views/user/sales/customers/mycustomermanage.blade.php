
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline;
        min-width: 1.5em;
        padding: 0px !important;
        margin-left: 0px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *: ;
        cursor: hand;
        color: #333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 0px;
    }
</style>

@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Center</b>
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
                        <li class="breadcrumb-item active">My Customer</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
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
                                <h3>Manage Product</h3>  
                            </div>
                            <div class="card-body">
                                <h5>Product Sub-Categories</h5>

                                <div class="row">
                                    <div class="col-md-8">
                                    <select class="form-control" name="filter_category" id="filter_category" required>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->subcat_id }}" {{ $subcategory->subcat_id == old('category_id')?'selected' : ''}}>{{ $subcategory->subcat_name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <br />
                                <hr>
                                <br />
                                <div class="single-table">
                                    <div class="data-tables">
                                        <table class="text-center  yajra-datatable">
                                            <thead class="bg-light text-capitalize">
                                                <tr style="font-size: 11px">
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col" data-orderable="false">List Price</th>
                                                    <th scope="col" data-orderable="false">Discount T1</th>
                                                    <th scope="col" data-orderable="false">Discount T2</th>
                                                    <th scope="col" data-orderable="false">Discount T3</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody  style="font-size: 11px">
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script type="text/javascript">
        function editProduct(productId){
            var url = window.location.href.split("/");
            var companyId = url[url.length-1].replace("#", "");
            // alert(url[url.length-1].replace("#", ""));
            // alert(productId);
            window.location.href = "../manageProduct/"+productId+"/"+companyId;
        }
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: { 
                    url: "{{ route('user.sales.products.getproducts') }}",
                    data: function(d) {
                        d.filter_category = $('#filter_category').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category_name', name: 'product_categories.name'},
                    {data: 'brand_name', name: 'brands.name'},
                    {data: 'list_price', name: 'products.price'},
                    {data: 'discount_tier1', name: 'product_discounts.discount_tier1'},
                    {data: 'discount_tier2', name: 'product_discounts.discount_tier2'},
                    {data: 'discount_tier3', name: 'product_discounts.discount_tier3'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


            // filter dropdown
            $('#filter_category').change(function(){
              table.draw();
            });

            // open modal
            // $(document).on('click', '.update', function(){
            //     $('#discountModal').modal('show');
            // });


                // $('#ok_button').click(function(){
                // $.ajax({
                // url:"sample/destroy/"+user_id,
                // beforeSend:function(){
                // $('#ok_button').text('Deleting...');
                // },
                // success:function(data)
                // {
                // setTimeout(function(){
                //     $('#confirmModal').modal('hide');
                //     $('#user_table').DataTable().ajax.reload();
                //     alert('Data Deleted');
                // }, 2000);
                // }
                // })
                // });

            // });


    });



    </script>

@endsection
