@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Industry ecommerce system') }}</title>
@endsection

@section('style')
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
                                <img class="d-block w-100" src="{{ asset('images/banners/photo1.jpg')}}"
                                     alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/banners/photo2.jpg')}}"
                                     alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/banners/photo3.jpg')}}"
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
        <div class="row">
        <div class="category-grid">
            @foreach($productcategories as $productcategory )
                @if (count($productcategory->subCategories))
                    @if($productcategory->subProducts->count()>0)
                        <div class="category-grid-item">
                            <div class="category-grid-media">
                                <img src="{{asset('storage/categories/'.$productcategory->image)}}" class="category-grid-media-image" alt="{{$productcategory->name}}">
                            </div>
                            <div class="category-level">

                                <?php $count = 0; ?>
                                @foreach($productcategory->subCategories as $subcategory )
                                    @if ($subcategory->products->count()>0)
                                    <?php if($count == 8) break; ?>
                                    <div class="category-level-item">
                                        <a href="product/{{$productcategory->slug}}/{{$subcategory->slug}}/{{$subcategory->id}}?categoryid={{$subcategory->id}}" class="category-level-item" title="{{$subcategory->name}}">{{$subcategory->name}}</a>
                                    </div>
                                     <?php $count++; ?>
                                     @endif
                                @endforeach
                            </div>
                            <div class="category-grid-item-name">
                                <a href="product/{{$productcategory->slug}}/{{$productcategory->id}}?categoryid={{$productcategory->id}}" class="category-grid-item-name-link" title="{{$productcategory->name}}">
                                    {{$productcategory->name}}
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.carousel').carousel()
    </script>
@endsection
