@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Industry ecommerce system') }}</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_section shop_el_slider">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('images/banners/photo-1.webp')}}"
                                     alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/banners/photo-2.webp')}}"
                                     alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/banners/photo-3.webp')}}"
                                     alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section pb_20 small_pt">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sale-banner mb-3 mb-md-4"><a
                                href="#"
                                class="hover_effect1"><img
                                    src="{{ asset('images/banners/promo1.png')}}"
                                    alt="Image 1"></a></div>
                    </div>
                    <div class="col-md-4">
                        <div class="sale-banner mb-3 mb-md-4"><a
                                href="#" class="hover_effect1"><img
                                    src="{{asset('images/banners/promo2.png')}}"
                                    alt="Image 2"></a></div>
                    </div>
                    <div class="col-md-4">
                        <div class="sale-banner mb-3 mb-md-4"><a
                                href="#"
                                class="hover_effect1"><img
                                    src="{{asset('images/banners/promo3.png')}}"
                                    alt="Image 3"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2"><h2>Our Brands</h2></div>
                        </div>
                    </div>
                        @foreach ($brands as $brand)
                            @if($image = @file_get_contents(asset('storage/brands/'.$brand->logo)))
                                <div class="col col-6 col-sm-4 col-md-4 col-lg-2">
                                    <div style="width: 194px; margin-right: 30px;">
                                        <img  src="{{ asset('storage/brands/'.$brand->logo) }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.carousel').carousel()
    </script>
@endsection
