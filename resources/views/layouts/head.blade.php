<!-- START HEADER -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<header class="header_wrap fixed-top header_with_topbar">
    <div class="top-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                        <ul class="header_list">
                            @if (!auth('web')->check())
                            <li><a href="{{ route('login') }}"><i class="ti-user"></i><span>Login</span></a></li>
                            <li><a href="register"><span>Register</span></a></li>
                            @else
                                <li><a href="profile"><i class="ti-user"></i><span>{{ auth('web')->user()->first_name }}</span></a></li>
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

            </div>
        </div>
    </div>
    <div class="bottom_header light_skin main_menu_uppercase bg_dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('images/industry2u_bw_150.png')}}" alt="INdustry2u - Industry Ecommerce System" />
                        </a>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-8">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li class="active">
                                    <a class=" nav-link nav_item " href="{{ url('/') }}">
                                        Home
                                    </a>
                                </li>
                                <li class="  ">
                                    <a class=" nav-link nav_item " href="#">
                                        Products
                                    </a>
                                </li>
                            </ul>
                        </div>

                            <ul class="navbar-nav attr-nav align-items-center">
                                <li><a href="#" class="nav-link "><span>Wanted List</span></a></li>
                            </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
