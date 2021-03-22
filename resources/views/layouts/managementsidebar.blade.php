<style>
.nav-link[data-toggle].collapsed:after {
    content: " ▾";
}
.nav-link[data-toggle]:not(.collapsed):after {
    content: " ▴";
}
</style>
<div class="dashboard_menu">
    <ul class="nav nav-tabs flex-column" role="tablist">
        <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#companymenu" data-toggle="collapse" data-target="#companymenu"> <i class="ti-layout-cta-right"></i><span class="d-none d-sm-inline">Company Management</span><i class="fa fa-table"></i></a>
            <div class="collapse  {{  request()->routeIs('user.company') ? 'show' : '' }} {{  request()->routeIs('user.company.edit') ? 'show' : '' }} {{  request()->routeIs('user.bankinfo') ? 'show' : '' }} {{  request()->routeIs('user.bankinfo.*') ? 'show' : '' }}" id="companymenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link  {{  request()->routeIs('user.company') ? 'active' : '' }} {{  request()->routeIs('user.company.edit') ? 'active' : '' }}" href="{{ route("user.company") }}" style="padding-left:33px;">Company Profile</a>
                  </li>
				  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.bankinfo') ? 'active' : '' }} {{  request()->routeIs('user.bankinfo.*') ? 'active' : '' }}" href="{{ route("user.bankinfo") }}" style="padding-left:33px;">Bank & SST Info</a>
                  </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#usermenu" data-toggle="collapse" data-target="#usermenu"> <i class="ti-user"></i><span class="d-none d-sm-inline">User Management</span><i class="fa fa-table"></i></a>
            <div class="collapse {{  request()->routeIs('user.invite') ? 'show' : '' }} {{  request()->routeIs('user.manage') ? 'show' : '' }} {{  request()->routeIs('user.manage.*') ? 'show' : '' }} {{  request()->routeIs('user.reporting') ? 'show' : '' }} {{  request()->routeIs('user.reporting.*') ? 'show' : '' }}" id="usermenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.invite') ? 'active' : '' }}" href="{{ route('user.invite') }}" style="padding-left:33px;">Invite User</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.manage') ? 'active' : '' }} {{  request()->routeIs('user.manage.*') ? 'active' : '' }}" href="{{ route('user.manage') }}" style="padding-left:33px;">Manage User</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.reporting') ? 'active' : '' }} {{  request()->routeIs('user.manage.*') ? 'active' : '' }}" href="{{ route('user.reporting') }}" style="padding-left:33px;">Reporting Line</a>
                  </li>
                </ul>
            </div>
        </li>
        @if (auth('web')->user()->is_seller)
        <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#pricemenu" data-toggle="collapse" data-target="#pricemenu"> <i class="ti-money"></i><span class="d-none d-sm-inline">Price Management</span><i class="fa fa-table"></i></a>
            <div class="collapse  {{  request()->routeIs('user.discount.*') ? 'show' : '' }}" id="pricemenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link  {{  request()->routeIs('user.discount.*') ? 'active' : '' }}" href="{{ route('user.discount.index') }}" style="padding-left:33px;">Manage Sales Discount</a>
                  </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</div>
