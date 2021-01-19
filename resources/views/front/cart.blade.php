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
        <div class="container">
            <form class="form--shopping-cart" method="post" action="{{ route("public.cart.update") }}">
                @csrf
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
                            @if ($cart)
                                <div class="table-responsive shop_cart_table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-supplier">Supplier</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $sId => $data)
                                                @foreach($data as $id => $item)

                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                @if ($item["product_filepath"])
                                                                <a href="{{route('public.products.show',['product' => $id, 'slug'=>$item["product_slug"]])}}">
                                                                    <img src="{{ asset('storage/'.$item["product_filepath"]) }}" alt="{{$item["product_name"]}}">
                                                                </a>
                                                                @else
                                                                    <img src="{{ asset('images/noimage.jpg') }}">
                                                                @endif
                                                            </td>
                                                            <td class="product-name" data-title="Product">
                                                                {!! link_to_route('public.products.show', $item["product_name"], ['product' => $id, 'slug'=>$item["product_slug"]]) !!}
                                                            </td>
                                                            <td class="supplier-name" data-title="Supplier">
                                                                {{$item["supplier_name"]}}
                                                            </td>
                                                            <td class="product-quantity" data-title="Quantity">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus">
                                                                    <input type="text" value="{{$item["qty"]}}" title="Qty" class="qty" size="4" name="items[{{$sId}}][{{$id}}][qty]">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </td>
                                                            <td class="product-remove" data-title="Remove"><a href="{{route('public.cart.remove',['company' => $sId, 'product'=>$id])}}" class="remove-cart-button"><i class="ti-close"></i></a></td>
                                                        </tr>

                                                @endforeach
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6" class="px-0">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-lg-12 col-md-12 text-md-right">
                                                        <button type="submit" class="btn btn-line-fill btn-sm">Update cart</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tfoot>
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
                            @else
                                <div class="text-center">
                                    Your wanted list is empty!
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </form>
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
                    <button type="button" class="btn btn-fill-line confirm-remove-item-cart">{{ __('Yes, remove it!') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
