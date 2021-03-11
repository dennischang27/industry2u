@extends('layouts.app')

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Management Centre</b>
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
                        <li class="breadcrumb-item"><a href="{{ route('user.discount.index')}}">Discount Settings</a></li>
                        <li class="breadcrumb-item active">Manager</li>

                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.managementsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">

                        <div class="card">
                            <div class="card-header">
                                <h3>Discount Settings</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.discount.manager')}}">
                                    @csrf        
                                        <div class="row">
                        
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group row">
                                                    <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                                                    <div class="col-sm-3">
                                                        <input style="height: 40px" class="form-control" name="manager_tier1" placeholder="discount tier 1" value="{{ $discount->manager_tier1 }}" required> 
                                                    </div>
                                                    <div style="margin-top: 0.5%">
                                                        <h4>%</h4>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                    <div class="col-sm-3">
                                                        <input style="height: 40px" class="form-control" name="manager_tier2" placeholder="discount tier 2" value="{{ $discount->manager_tier2 }}" required>
                                                    </div>
                                                    <div style="margin-top: 0.5%">
                                                        <h4>%</h4>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="discount_tier1" class="col-sm-3 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                    <div class="col-sm-3">
                                                        <input style="height: 40px" class="form-control" name="manager_tier3" placeholder="discount tier 3" value="{{ $discount->manager_tier3 }}" required>
                                                    </div>
                                                    <div style="margin-top: 0.5%">
                                                        <h4>%</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="" style="margin-top: 5%">
                                            <a class="btn btn-info btn-xs" href="{{ route('user.discount.index') }}">Cancel</a>
                                            <button type="submit" class="btn btn-success btn-xs" style="float: right;">Save</button>
                                        </div>
                        
                                </form>


                                <div class="" style="margin-top: 10%">
                                    <h4>Guide</h4><br>
                    
                                    If Listing Price = RM100 and set Discount Tier 1 at 30%, Discount Tier 2 at 10% and Discount Tier 3 at 5%.
                                    <br /><br />
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
                                        <br />

                                        <li>Discount Tier 2(10%), Discounted Amount: 70 x 30% = RM7
                                        </li>
                                        <ul style="padding-left: 5%">
                                            <li style="list-style-type: circle;">
                                                Quotation Price = Listing Price - Discounted Tier 1 Amount - Discounted Tier 2 Amount </li>
                                                
                                            <li style="list-style-type: circle;">
                                                RM 100 - 30 - 7 = RM 63
                                            </li>
                                            </ul>
                                            <br />

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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




