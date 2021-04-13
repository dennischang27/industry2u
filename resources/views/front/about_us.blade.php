@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' ABOUT US') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
@endsection
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>COMPANY INFO</h1>
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
                    <li class="breadcrumb-item active">About Us</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<style>
  body {
    font: Lato, sans-serif;
    line-height: 1.8;
    color: #ffffff;
  }
  h6 {
    font-weight: 750;
    font-size: 65px;
    color:white;
  }
  h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 700;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 18px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
  }  
  .jumbotron {
    background-color: #f29846;
    color: #fff;
    padding: 20px 25px;
    font-family: Montserrat, sans-serif;
  }
  .container-fluid {
    padding: 35px 10px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .i {
    color: #f4511e;
    font-size: 200px;
  }
  .carousel-indicators li {
    border-color: #faa558;
  }
  .carousel-indicators li.active {
    background-color: #77caf2;
  }
  .h7 {
    font-size: 17px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .navbar {
    margin-bottom: 0;
    background-color: f39d50;
    z-index: 9999;
    border: 0;
    font-size: 19px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
}
</style>
@endsection
@section('content')
<div class="jumbotron text-center">
    <h6>Industry2U</h6><br>
    <!-- <img src="{{ asset('images/banners/photo-2.webp')}}" alt="photo2" width="100%" height="30%"> -->
    <img src="{{ asset('images/banners/img8.jpg')}}"  width="487" height="330">
    <img src="{{ asset('images/banners/img7.jpg')}}"  width="487" height="330">
    <img src="{{ asset('images/banners/img4.jpg')}}"  width="487" height="330">
</div>
<!-- Container (About Section) -->
<br><div class="container">
    <div id="about" class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h2>About Industry2U</h2><br>
                <h4>Industry2u is a supply chain system that enables industrial players to simplify the process for product sourcing and supplying.</h4>
                <br>
                <div class="button">  
                    <a class="btn btn-primary btn-md" href="{{ route("contact_us") }}">Get in Touch</a>
                </div></div><br>
            <div class="col-sm-3">
                <i class="fas fa-chart-pie" style="font-size:200px; color:#f4511e;"></i>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-grey">
        <div class="row">
            <div class="col-sm-3">
                <i class="fas fa-globe-asia" style="font-size:200px; color:#f4511e;"></i>
            </div>
            <div class="col-sm-9">
                <h2>Our Values</h2><br>
                <h4><strong>MISSION:</strong> To create a mutually beneficially, collaborative business environment for all stakeholders.</h4>
                <h4><strong>VISION:</strong> To become South East Asia Largest Industrial Business Trading Platform.</h4>
            </div>
        </div>
    </div>
<!-- Container (Culture Section) -->
<div id="services" class="container-fluid text-center">
  <hr><h2>Our CULTURE</h2>
  <h4>We are an ambitious team who are passionate about what we do.</h4>
  <h4>We cherish integrity, innovativeness and collaboration. We believe that Teamwork is the central to success.</h4><hr>
</div>
<!-- Container (Services Section) -->
<div id="portfolio" class="container-fluid bg-grey text-center">
  <h2>SERVICES</h2>
  <h4>As a platform, we continue to develop services to help businesses do more and discover new opportunities. Industry2U brings you hundreds of thousands of machinery products in over 30 different major categories.</h4>
  <div class="row text-center slideanim">
    <div class="col-sm-4">
        <img src="{{ asset('images/banners/img2.jpeg')}}" width="300" height="300">
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('images/banners/img3.jpeg')}}" width="300" height="300">
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('images/banners/img1.jpeg')}}" width="300" height="300">
    </div>
  </div><br></div><br>
</div>

<!-- <div id="portfolio" class="container-fluid text-center bg-grey">
    <h2>What our customers say</h2>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <h4>"This company is the best. I am so happy with the result!"<br><span>Jia Song, Digital Blueocean Bhd</span></h4>
        <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        <h4>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div> -->
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-greyxx text-center">
    <p style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;"><strong>WORKING HOURS:</strong></p>
        <td><span style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">&nbsp;Monday - Friday:</span></td>
        <td><span style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">&nbsp;09:00 - 18:00</span></td>            <tr><br>
        <td><span style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">&nbsp;Saturday & Sunday/Public Holidays:</span></td>
        <td><span style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">Closed</span></td><br><br>
        <label for="email" style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">ADDRESS:</label><br>
        <img src="{{ asset('images/banners/digitalocean_logo.png')}}" width="200" height="30">
    <p><span style="font-size: 12pt; font-family: arial, helvetica, sans-serif; color: #000000;">F-1, 48, Jalan PJU 1a/3, Taipan Damansara 2, 47301 Petaling Jaya, Selangor</span></p>
</div>
@endsection