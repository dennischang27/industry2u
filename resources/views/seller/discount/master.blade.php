@extends('seller.layouts.app')

@section('style')
    <style>
        .profile-img{
            text-align: center;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><a>Discount Setting</a></li>
                        <li><span> Master</span></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
@endsection

@section('content')
    <div class="col-12 mt-5">
        <div class="card-header">
            <h3>Discount Settings - Master</h3>
        </div>
        <form method="POST" action="{{route('seller.discount.master')}}">
            @csrf

            <div class="card-body">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group row">
                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                            <div class="col-sm-3">
                                <input class="form-control" name="master_tier1" placeholder="discount tier 1" title="" required> 
                            </div>
                            <div style="margin-top: 1%">
                                <h4>%</h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                            <div class="col-sm-3">
                                <input class="form-control" name="master_tier2" placeholder="discount tier 2" title="" required>
                            </div>
                            <div style="margin-top: 1%">
                                <h4>%</h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                            <div class="col-sm-3">
                                <input class="form-control" name="master_tier3" placeholder="discount tier 3" title="" required>
                            </div>
                            <div style="margin-top: 1%">
                                <h4>%</h4>
                            </div>
                        </div>
                        

                    </div>

                </div>

                <div class="" style="margin-top: 5%">
                    <a class="btn btn-info" href="{{ route('seller.discount.index') }}">Cancel</a>

                    <button type="submit" class="btn btn-success" style="float: right;">Save</button>
                </div>

        </form>

            <div class="" style="margin-top: 10%">
                <h4>Guide</h4><br>

                If Listing Price = RM100 and set Discount Tier 1 at 30%, Discount Tier 2 at 10% and Discount Tier 3 at 5%.

                <ol style="padding-left: 2%">
                    <li>Discount Tier 1(30%), Discounted Amount: 100 x 30% = RM30 
                    </li>
                    <ul style="padding-left: 5%">
                    <li style="list-style-type: circle;">
                            Quotation Price = Listing Price - Discounted Tier 1 Amount
                        </li>
                        
                    <li style="list-style-type: circle;">
                            RM 100 - 30 = RM 70</li>
                    </ul>  
                    <li>Discount Tier 2(10%), Discounted Amount: 70 x 30% = RM7
                    </li>
                    <ul style="padding-left: 5%">
                        <li style="list-style-type: circle;">
                            Quotation Price = Listing Price - Discounted Tier 1 Amount - Discounted Tier 2 Amount </li>
                            
                        <li style="list-style-type: circle;">
                            RM 100 - 30 - 7 = RM 63
                        </li>
                        </ul>
                    <li>Discount Tier 3(5%), Discounted Amount: RM63 x 5% = RM 3.15
                    </li>
                    <ul style="padding-left: 5%">
                        <li style="list-style-type: circle;">
                            Quotation Price = Listing Price - Discounted Tier 1 Amount - Discounted Tier 2 Amount - Discounted Tier 3 Amount                           </li>
                            
                        <li style="list-style-type: circle;">
                            RM 100 - 30 - 7 - 3.15= RM 59.85</li>
                        </ul>
                </ol>
            </div>
        </div>
    </div>
@endsection


