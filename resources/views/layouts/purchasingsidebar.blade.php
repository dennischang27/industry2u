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
            <a class="nav-link collapsed text-truncate" href="#suppliermenu" data-toggle="collapse" data-target="#suppliermenu"> <i class="ti-user"></i><span class="d-none d-sm-inline">Supplier Management</span><i class="fa fa-table"></i></a>
            <div class="collapse  {{  request()->routeIs('user.suppliermanagement.*') ? 'show' : '' }} " id="suppliermenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.suppliermanagement.supplierinvitation') ? 'active' : '' }}" href="{{ route('user.suppliermanagement.supplierinvitation') }}" style="padding-left:33px;">Supplier Invitation</a>
                  </li>
				  <li class="nav-item">
                      <a class="nav-link {{  request()->routeIs('user.suppliermanagement.mysupplier') ? 'active' : '' }}" href="{{ route('user.suppliermanagement.mysupplier') }}" style="padding-left:33px;">My Supplier</a>
                  </li>
                </ul>
            </div>
        </li>
        @if (auth('web')->user()->is_buyer)
        <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#companymenu" data-toggle="collapse" data-target="#companymenu"> <i class="ti-layout-cta-right"></i><span class="d-none d-sm-inline">Quotation</span><i class="fa fa-table"></i></a>
            <div class="collapse  {{  request()->routeIs('buyer.*') ? 'show' : '' }}" id="companymenu" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                    <li class="nav-item">
                        <a class="nav-link  {{  request()->routeIs('buyer.quote') ? 'active' : '' }}" href="{{ route("buyer.quote") }}" style="padding-left:33px;">To Quote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{  request()->routeIs('buyer.quote.issued') ? 'active' : '' }}" href="{{ route("buyer.quote.issued") }}" style="padding-left:33px;">Quotation Issued</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</div>
