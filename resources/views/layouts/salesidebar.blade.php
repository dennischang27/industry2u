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

    
            @hasanyrole('Admin|Moderator')
            <li class="nav-item">
                <a class="nav-link collapsed text-truncate" href="#pricingmenu" data-toggle="collapse" data-target="#pricingmenu"> <i class="ti-money"></i><span class="d-none d-sm-inline">Sales Management</span><i class="fa fa-table"></i></a>
                <div class="collapse  {{  request()->routeIs('user.pricemanagement.*') ? 'show' : '' }} " id="pricingmenu" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                      <li class="nav-item">
                          <a class="nav-link  {{  request()->routeIs('user.pricemanagement.index') ? 'active' : '' }}" href="{{ route('user.pricemanagement.index') }}" style="padding-left:33px;">Discount Management</a>
                      </li>
                    </ul>
                </div>
            </li>
            @endhasanyrole
    
            @if (auth('web')->user()->is_seller)
            <li class="nav-item">
                <a class="nav-link collapsed text-truncate" href="#quotationmenu" data-toggle="collapse" data-target="#quotationmenu"> <i class="ti-layout-cta-right"></i><span class="d-none d-sm-inline">Quatation</span><i class="fa fa-table"></i></a>
                <div class="collapse  {{  request()->routeIs('seller.*') ? 'show' : '' }}" id="quotationmenu" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                    <li class="nav-item">
                        <a class="nav-link  {{  request()->routeIs('seller.quote') ? 'active' : '' }}" href="{{ route("seller.quote") }}" style="padding-left:33px;">To Quote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{  request()->routeIs('seller.quote.issued') ? 'active' : '' }}" href="{{ route("seller.quote.issued") }}" style="padding-left:33px;">Quotation Issued</a>
                    </li>
                    </ul>
                </div>
            </li>
            @endif
           
        </ul>
    </div>
    