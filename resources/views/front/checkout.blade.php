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
                        <li class="breadcrumb-item">
                            <meta itemprop="position" content="1">
                            <a href="{{route("public.cart.view")}}" itemprop="item" title="Home">
                                Wanted List
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Confirm Wanted List</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <form class="form--shopping-cart" method="post" action="{{ route("public.cart.checkout.process") }}">
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
                                        <th class="product-quantity">Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($cart as $sId => $data)
                                            <?php $company =\App\Models\Company::find($sId) ?>
                                            <tr>
                                                <td colspan="3">
                                                   <strong>Supplier:  {{ $company->name}}</strong>
                                                </td>
                                            </tr>
                                            @foreach($data as $id => $item)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        @if ($item["product_filepath"])
                                                            <img src="{{ asset('storage/'.$item["product_filepath"]) }}" alt="{{$item["product_name"]}}">
                                                        @else
                                                            <img src="{{ asset('images/noimage.jpg') }}">
                                                        @endif

                                                    </td>
                                                    <td class="product-name" data-title="Product">
                                                        {{$item["product_name"]}}
                                                    </td>
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <div class="quantity">
                                                            {{$item["qty"]}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-0">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-lg-12 col-md-12 text-md-right">
                                                    <button type="button" class="btn btn-fill-out">Send Request</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
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
@endsection

@section('script')

@endsection
