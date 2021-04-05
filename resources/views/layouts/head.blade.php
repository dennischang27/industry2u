<!-- START HEADER -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<header class="header_wrap fixed-top header_with_topbar">
    <div class="top-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <!--<div class="col-md-6">
                    @if (auth('web')->check())
                        @if (!auth('web')->user()->is_seller )
                            @if (!auth('web')->user()->is_buyer )
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <ul class="contact_detail text-center text-lg-left">
                                    <li><a href="{{ route('apply.seller.company') }}" class="btn btn-xs btn-primary"><span>Become Supplier</span></a></li>
                                </ul>
                            </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                    <ul class="contact_detail text-center text-lg-left">
                                        <li><a href="{{ route('upgrade.seller.company') }}" class="btn btn-xs btn-primary"><span>Become Supplier</span></a></li>
                                    </ul>
                                </div>
                            @endif
                        @else
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <ul class="contact_detail text-center text-lg-left">
                                    <li><a href="{{ route('seller.dashboard') }}" target="_blank" class="btn btn-xs btn-primary"><span>Supplier Centre</span></a></li>
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>-->

                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                        <ul class="header_list">
                            @if (!auth('web')->check())
                            <li><a href="{{ route('login') }}"><i class="ti-user"></i><span>Login</span></a></li>
                            <li><a href="{{ route('register') }}"><span>Register</span></a></li>
                            @else


                                <!-- Nav Item - User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-lg-inline small">{{ auth('web')->user()->first_name }}</span>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                             aria-labelledby="userDropdown">
                                            @if (!auth('web')->user()->is_buyer )
                                                <a class="dropdown-item"  href="{{ route('addcompany') }}"><span>Register Company</span></a>
                                            @else
                                                <a class="dropdown-item"  href="{{ route('user.company') }}"><span>Company Profile</span></a>
                                            @endif
                                             <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route("user.account") }}"><span>Account</span></a>
                                            <a class="dropdown-item" href="{{ route("user.profile") }}"><span>Edit Profile</span></a>
                                        </div>
                                    </li>
                                <!--li><a href="{{ route('user.account') }}"><i class="ti-user"></i><span>{{ auth('web')->user()->first_name }}</span></a></li-->
                                <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();"><i class="ti-lock"></i><span>{{ __('Logout') }}</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo_dark" src="{{asset('images/industry2u_150.png')}}" alt="INdustry2u - Industry Ecommerce System" />
                </a>
                <div class="contact_phone order-md-last d-block d-sm-none">
                    <ul class="header_list">
                        @if (!auth('web')->check())
                            <li><a href="{{ route('login') }}"><i class="ti-user"></i></a></li>
                        @else
                            <li><a href="{{ route('user.account') }}"><i class="ti-user"></i><span>{{ auth('web')->user()->first_name }}</span></a></li>
                            <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();"><i class="ti-lock"></i><span>{{ __('Logout') }}</span></a></li>
                        @endif
                    </ul>
                </div>
                <div  id="serch_form" class="product_search_form float-left">
                    <form action="{{ route('public.products') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Search Product..." required="" type="text">
                            <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="bottom_header light_skin main_menu_uppercase bg_dark">
        <div class="container">
            <div class="row">
				<div class="col-lg-2 col-md-4 col-sm-6 col-4">
					<a class="navbar-brand" href="{{ url('/') }}">
						<img src="{{asset('images/industry2u_bw_150.png')}}" alt="INdustry2u - Industry Ecommerce System" />
					</a>
				</div>

				<div class="col-lg-10 col-md-8 col-sm-6 col-8">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                @if (auth('web')->check())
                                    @hasrole('Admin|Moderator')
                                        <li class="active centre_mobile">
                                            <a class=" nav-link nav_item " href="{{route('user.company')}}">
                                                Management
                                            </a>
                                        </li>
                                    @endhasrole
                                    @if (auth('web')->user()->is_seller)
                                        @hasrole('Admin|Moderator|Sales Moderator|Sales Manager|Sales Executive')
                                        <li class="centre_mobile">
                                            <a class=" nav-link nav_item " href="{{route('seller.quote')}}">
                                                Sales
                                            </a>
                                        </li>
                                        @endhasrole
                                    @endif
                                    @if (auth('web')->user()->is_buyer)
                                        @hasrole('Admin|Moderator|Purchasing Moderator|Purchasing Manager|Purchasing Executive|Engineer|Clerical Staff')
                                        <li class="centre_mobile">
<<<<<<< HEAD
                                            <a class=" nav-link nav_item " href="{{route('user.suppliermanagement.supplierinvitation')}}">
=======
                                            <a class=" nav-link nav_item " href="{{route('buyer.quote')}}">
>>>>>>> b5a647c9c1dd745eed52d9666ea0600307c10552
                                                Purchasing
                                            </a>
                                        </li>
                                        @endhasrole
                                    @endif

                                    @hasrole('Admin|Moderator')
                                        <div class="text-center centre_web" style="padding: 10px 0;">
                                            <a href="{{ route('user.company') }}" class="btn btn-success" style="padding: 10px 25px;" role="button">Management</a>
                                        </div>
                                    @endhasrole
									@if (auth('web')->user()->is_seller)
                                        @hasrole('Admin|Moderator|Sales Moderator|Sales Manager|Sales Executive')
                                            <div class="text-center centre_web" style="padding: 10px 0;">
                                                <a href="{{ route('seller.quote') }}" class="btn btn-primary" style="padding: 10px 25px;margin-left:10px;" role="button">Sales</a>
                                            </div>
                                        @endhasrole
									@endif
									@if (auth('web')->user()->is_buyer)
                                        @hasrole('Admin|Moderator|Purchasing Moderator|Purchasing Manager|Purchasing Executive|Engineer|Clerical Staff')
                                            <div class="text-center centre_web" style="padding: 10px 0;">
                                                <a href="{{ route('user.suppliermanagement.supplierinvitation') }}" class="btn btn-warning" style="padding: 10px 25px;margin-left:10px;" role="button">Purchasing</a>
                                            </div>
                                        @endhasrole
									@endif
                                @endif
                            </ul>
                        </div>
                        <div id="serch_form2" class="product_search_form_nav float-left float-sm-right" >
                            <form action="{{ route('public.products') }}" method="GET"  >
                                <div class="input-group">
                                    <input class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Search Product..." required="" type="text">
                                    <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                                </div>
                            </form>
                        </div>

                            <ul class="navbar-nav attr-nav align-items-center">
                                <li >
                                    <a class=" nav-link nav_item " href="{{route('public.products')}}">
                                        Products
                                    </a>
                                </li>
                                <li><a href="{{ route('public.wantedlist.view') }}" class="nav-link  cart_trigger btn-shopping-cart">Wanted List
                                        <span class="cart_count">
                                        @if (session('total_wanted_list'))
                                            {{ session('total_wanted_list') }}
                                        @else
                                            {{session()->get('total_wanted_list')}}
                                        @endif

                                            {{--@php
                                                $c = array();
                                                $c = Session::get('cart');
                                                $sum = 0;
                                              if(!empty($c)){
                                                $c = array_filter($c);
                                                    foreach ($c as $p) {
                                                        foreach ($p as $item) {
                                                            $sum += $item['qty'];
                                                        }
                                                    }
                                              }else{
                                                $c = [];
                                              }

                                            @endphp

                                            {{ $sum }}--}}
                                           </span>
                                    </a></li>
                            </ul>
                        <div class="pr_search_icon">
                            <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
