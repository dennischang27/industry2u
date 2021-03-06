<form id="logout-form" action="{{ route('seller.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!-- header area start -->
<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-6 col-4 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-6 col-8 clearfix pull-right">
                <ul class="notification-area pull-right">
                    <li class="dropdown">
                        <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                            <span>0</span>
                        </i>
                        <div class="dropdown-menu bell-notify-box notify-box">
                            <span class="notify-title">You have 0 new notifications</span>
                            <div class="nofity-list">

                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        @if (!auth('web')->check())
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Jia Song<i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                            </div>
                        @else
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth('web')->user()->first_name }}<i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('seller.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                            </div>
                        @endif

                    </li>
                </ul>
        </div>
    </div>
</div>
<!-- header area end -->
