@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' FAQ') }}</title>
@endsection
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Frequently Asked Questions(FAQ)</h1>
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
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
<style>
    body {
    }
    .faqTop {
        font-size: 25px;
        margin: 20px;
        color:#2d3f88;
        font-weight: bolder;
    }
    .faqHeader {
        font-size: 25px;
        margin: 20px;
        color:black;
        
        font-weight: bolder;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);

    .search {
    width: 100%;
    position: relative;
    display: flex;
    }

    .searchTerm {
    width: 100%;
    border: 3px solid #5b5b5b;
    border-right: none;
    padding: 5px;
    height: 40px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #000000;
    }

    .searchTerm:focus{
    color: #5b5b5b;
    }

    .searchButton {
    width: 50px;
    height: 40px;
    border: 1px solid #5b5b5b;
    background: ##5b5b5b;
    text-align: center;
    color: #400080;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
    }

    /*Resize the wrap to see the search bar change!*/
    .wrap{
    width: 40%;
    height: 36px;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }
</style>
@endsection
@section('content')
<div class="container">
    <br />
        <!-- <div class="row">
        <div class="wrap">
            <div class="search">
            <input type="hidden" value="{{ request()->input('q') }}" name="q"  >
                <input type="text" name="q" value="{{ request()->input('q') }}" id="searchTerm" class="searchTerm" placeholder="How can we help you?">
                <button type="submit" class="searchButton">
                    <i class="linearicons-magnifier"></i>
                </button>
            </div>
        </div>
        </div> -->
        
        <div class="row" id="accordion">
            <div class="faqHeader">GENERAL QUESTIONS</div>
        </div>
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Is account registration required?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="card-block">
                    <div class="col">
                    Account registration at <strong>Industry2U</strong> is required if you are selling or buying items. 
                    This ensures a valid communication channel for all parties involved in any transactions. 
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">What is the currency used for all transactions?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse">
                <div class="card-block">
                    <div class="col">
                    All prices for listed products, including each seller's or buyer's account balance are in <strong>Malaysian Ringgit (MYR)</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="faqHeader">SELLERS</div>
        </div>
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Who can sell items?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="ti-arrow-circle-down"></i>
                </div> 
            </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="card-block">
                            <div class="col">
                            Any user with a registered company can sell their products on <strong>Industry2U</strong>.
                            </div>
                        </div>
                    </div>
        </div>
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">I want to sell my items - what are the steps?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="card-block">
                    <div class="col col">
                    The steps involved in this process are really simple. All you need to do is:
                        <li>Register an account</li>
                        <li>Create a company profile in order to be granted access as a Supplier</li>
                        <li>Go to the <strong>Supplier Center</strong> section and upload your products</li>
                </div></div>
            </div>
        </div>
        
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Why sell my items here?</a>
                </h4>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="card-block">
                    <div class="col">
                        We provide fast response and approval times.
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">What are the payment options?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseEight" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
                <div class="card-block">
                <div class="col">
                    The seller will submit a quotation to the buyers. This method ensures timely payments and a secured environment. 
                </div></div>
            </div>
        </div>
        <div class="row">
        <div class="faqHeader">BUYERS</div>
        </div>
        <div class="card ">
                <div class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">I want to buy a product - what are the steps?</a>
                    <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="ti-arrow-circle-down"></i>
                    </div>
                </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="card-block">
                <div class="col">
                    Buying a product on <strong>Industry2U</strong> is really simple.
                    Firstly, to gain access to the purchasing process, the SSM forms (Mandatory Form 9) along with other relevant information must be submitted to Industry2U during registration.
                    Once you have selected a product, you can quickly place an order and quotations will be given immediately.
                    <br />
                    Once the transaction is complete, you gain full access to the purchased product. 
                </div></div>
                </div>
            </div>
            <div class="card ">
            <div class="card-header">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsesatu">How long do I need to confirm my purchase?</a>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapsesatu" class="ti-arrow-circle-down"></i>
                </div>
            </div>
            <div id="collapsesatu" class="panel-collapse collapse in">
                <div class="card-block">
                    <div class="col">
                    The quotation given by the seller is only valid for 7 days. Buyers must confirm their purchase within 7 days after the issuance of the quotations.
                    </div>
                </div>
            </div>
        </div>
            <div class="card ">
            <div class="card-header">
                <div class="card-block">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsetiga">How do I become both Buyer and Seller?</a>
                </h4>
                <div class="float-right">
                    <i data-toggle="collapse" data-parent="#accordion" href="#collapsetiga" class="ti-arrow-circle-down"></i>
            </div>
            </div>
            </div>
            <div id="collapsetiga" class="panel-collapse collapse">
                <div class="card-block">
                    <div class="col col">
                    To gain access to both buyer and seller process, user has to provide the following infromations to Industry2U during registration:
                    <li>Register an account</li>
                    <li>Create a company profile in order to be granted access as a Supplier</li>
                    <li>Go to the <strong>Supplier Center</strong> section and upload your products</li>
                    </div>
                </div>
            </div>
        </div></li>
                </div>
            </div>
        </div>
            <br>
        </div>
    <br>
</div>
@endsection
@section('script')
    <div class="se-pre-con"></div>
    <script>
        $('#searchTerm').submit(function() {
            var pass = true;
            //some validations

            if(pass == false){
                return false;
            }
            $(".se-pre-con").fadeIn("slow");

            return true;
        });
    </script>
@endsection
