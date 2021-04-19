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
                        <li class="breadcrumb-item active">My Customers</li>
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
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Manage Product (By Product)</h3>
                            </div>

                            <div class="card-body">

                                <form id="product_form" action="{{ route('user.customermanagement.mycustomer.managebyProduct.store', $product) }}" class="form" method="post" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <h5 class="header-title">Product Information</h5>

                                            <br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6>Product Name:</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6>{{ $productDetails->name }} </h6>
                                                </div>
                                            </div>
            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6>Category:</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6>{{ $productDetails->category_name }} </h6>
                                                </div>
                                            </div>
            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6>Brand:</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6>{{ $productDetails->brand_name }} </h6>
                                                </div>
                                            </div>
            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6>List Price:</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6>{{ $productDetails->list_price }} </h6>
                                                </div>
                                            </div>

                                            <div class="row">
                        
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <br />

                                                    @if ($message = Session::get('error'))
                                                        <div class="alert alert-danger">
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                    @endif

                                                    @if ($message = Session::get('success'))
                                                        <div class="alert alert-success">
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                    @endif
                                                        

                                                    @if ($productCount == 0)

                                                        <div class="form-group row">
                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                            <input class="form-control" id="discount_tier1" name="discount_tier1" placeholder="discount tier 1" type="number" style="height: 40px" required> 
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="discount_tier2" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                                <input class="form-control" id="discount_tier2" name="discount_tier2" placeholder="discount tier 2" type="number" style="height: 40px" required>
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="discount_tier3" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                                <input class="form-control" id="discount_tier3" name="discount_tier3" placeholder="discount tier 3" type="number" style="height: 40px" required>
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                                        
                                                    @else

                                                        <div class="form-group row">
                                                            <label for="discount_tier1" class="col-sm-4 col-form-label"><strong>Discount Tier 1:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                            <input class="form-control" id="discount_tier1" name="discount_tier1" placeholder="discount tier 1" type="number" style="height: 40px" value="{{ $productDetails->discount_tier1 }}" required> 
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="discount_tier2" class="col-sm-4 col-form-label"><strong>Discount Tier 2:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                                <input class="form-control" id="discount_tier2" name="discount_tier2" placeholder="discount tier 2" type="number" style="height: 40px" value="{{ $productDetails->discount_tier2 }}" required>
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="discount_tier3" class="col-sm-4 col-form-label"><strong>Discount Tier 3:</strong><small class="text-danger">*</small></label>
                                                            <div class="col-sm-6">
                                                                <input class="form-control" id="discount_tier3" name="discount_tier3" placeholder="discount tier 3" type="number" style="height: 40px" value="{{ $productDetails->discount_tier3 }}"  required>
                                                            </div>
                                                            <div style="margin-top: 1%">
                                                                <h4>%</h4>
                                                            </div>
                                                        </div>
                                                        
                                                    @endif
                                                   
                                                        <br>
                                                        {{-- <p>parent id</p> --}}
                                                        <input class="form-control" type="hidden" id="parent_id" name="parent_id" value="{{$productDetails->parent_id}}">
                                                        <input class="form-control" type="hidden" id="subcat_id" name="subcat_id" value="{{$productDetails->subcat_id}}">
                                                        {{-- <p>master discount</p>
                                                        <input class="form-control" type="text" id="totalDiscountMaster" name="totalDiscount" value="{{ $masterDiscountTotal }}" >
                                                        <p>existing discount</p>
                                                        <input class="form-control" type="text" id="totalDiscountExisting" name="total_discount" value=""> --}}
                                                        {{-- <p>customer company id</p> --}}
                                                        <input class="form-control" type="hidden" id="customer_company_id" name="customer_company_id" value="{{$customerCompanyId}}">
                                                        {{-- <p>product id</p> --}}
                                                        <input class="form-control" type="hidden" id="product_id" name="product_id" value="{{$product}}">
                                                </div>
                                
                                            </div>
        
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" id="formSubmit">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


