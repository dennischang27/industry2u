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
            <div class="collapse  {{  request()->routeIs('user.company') ? 'show' : '' }} {{  request()->routeIs('user.company.edit') ? 'show' : '' }}" id="companymenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link  {{  request()->routeIs('user.company') ? 'active' : '' }} {{  request()->routeIs('user.company.edit') ? 'active' : '' }}" href="{{ route("user.company") }}" style="padding-left:33px;">Company Profile</a>
                  </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#usermenu" data-toggle="collapse" data-target="#usermenu"> <i class="ti-user"></i><span class="d-none d-sm-inline">User Management</span><i class="fa fa-table"></i></a>
            <div class="collapse " id="usermenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link  " href="#" style="padding-left:33px;">Invite User</a>
                  </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
