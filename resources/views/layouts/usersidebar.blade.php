<div class="dashboard_menu">
    <ul class="nav nav-tabs flex-column" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{  request()->routeIs('user.account') ? 'active' : '' }}" href="{{ route("user.account") }}"><i class="ti-layout-grid2"></i>Account</a>
        </li>
        @if (!auth('web')->user()->is_buyer)
        <li class="nav-item">
            <a class="nav-link  {{  request()->routeIs('addcompany') ? 'active' : '' }}" href="{{ route("addcompany") }}"><i class="ti-map-alt"></i>Add Company</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link  {{  request()->routeIs('user.company') ? 'active' : '' }} {{  request()->routeIs('user.company.*') ? 'active' : '' }}" href="{{ route("user.company") }}"><i class="ti-map-alt"></i>Company Profile</a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link  {{  request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route("user.profile") }}"><i class="ti-id-badge"></i>Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{  request()->routeIs('user.changepassword') ? 'active' : '' }}" href="{{ route("user.changepassword") }}"><i class="ti-id-badge"></i>Change password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route("logout") }}" onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();"><i class="ti-lock"></i>Logout</a>
        </li>
    </ul>
</div>
