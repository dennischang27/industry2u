@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Wanted List') }}</title>
@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h3>Wanted List</h3>
                    </div>
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
                        <li class="breadcrumb-item active">Wanted List</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
        @if (\Session::has('success'))
            <div class="container alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if (!auth('web')->user()->is_buyer )
                            <div class="text-center">
                                Your wanted list is empty!
                            </div>
                            <div class="text-center">
                                Please <a href="{{ route("addcompany") }}">submit company information</a> in order to request.
                            </div>
                        @else
                            @if (!$wanted_lists->isEmpty())
                            <form class="form--shopping-cart" method="post" action="{{ route("public.wantedlist.request") }}">
                            @csrf
                                <div class="table-responsive shop_cart_table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="checked_all"></th>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-supplier">Supplier</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-remove">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wanted_lists as $wanted_list)
                                                <tr>
                                                    <td>
                                                        <input name='wanted_list_id[]' type="checkbox" class="checkbox" value="{{$wanted_list->id}}">
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        @if ($wanted_list->product_filepath)
                                                            <a href="{{route('public.products.show',['product' => $wanted_list->product_id, 'slug'=>$wanted_list->product_slug])}}">
                                                                <img src="{{ asset('storage/'.$wanted_list->product_filepath) }}" alt="{{$wanted_list->product_name}}">
                                                            </a>
                                                        @else
                                                            <img src="{{ asset('images/noimage.jpg') }}">
                                                        @endif
                                                    </td>
                                                    <td class="product-name" data-title="Product">
                                                        {!! link_to_route('public.products.show', $wanted_list->product_name, ['product' => $wanted_list->product_id, 'slug'=>$wanted_list->product_slug]) !!}
                                                    </td>
                                                    <td class="supplier-name" data-title="Supplier">
                                                        {{$wanted_list->supplier_company_name}}
                                                    </td>
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <div class="quantity">
                                                            <input type="button" value="-" class="minus">
                                                            <input type="text" value="{{$wanted_list->quantity}}" title="Qty" class="qty" size="4" name="items[{{$wanted_list->id}}][{{$wanted_list->product_id}}][$wanted_list->quantity]">
                                                            <input type="button" value="+" class="plus">
                                                        </div>
                                                    </td>
                                                    <td class="product-remove" data-title="Remove">
                                                        <a onclick="updateProduct(this, {{$wanted_list->id}})" href="#"><i class="ti-pencil"></i></a>
                                                        <a onclick="return confirm('{{ __("Are you sure you want to remove this product from cart?") }}')" href="{{route('public.wantedlist.remove',['wanted_list' => $wanted_list->id, 'product'=>$wanted_list->product_name])}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="medium_divider"></div>
                                        <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                                        <div class="medium_divider"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-fill-out" name="checkout">Send Request</button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <div class="text-center">
                                    Your wanted list is empty!
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
        </div>
    </div>
    <div id="remove-item-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Warning') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to remove this product from cart?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-fill-out" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-fill-line confirm-remove-item-cart-1">{{ __('Yes, remove it!') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.checked_all').on('change', function() {     
            $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked    
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                    $('.checked_all').prop('checked',true);
            }else{
                    $('.checked_all').prop('checked',false);
            }
        });

        function updateProduct(elm, wanted_list_id) {
            var quantity = $( elm ).parent().siblings(".product-quantity").find('.qty').val();
            var url = '{{ route("public.wantedlist.update", [":id", ":qty"]) }}';
            url = url.replace(':id', wanted_list_id);
            url = url.replace(':qty', quantity);
            window.location.href = url;
        }
    </script>
@endsection
