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

            @if (auth('web')->user()->is_seller)
            <li class="nav-item">
                <a class="nav-link collapsed text-truncate" href="#customermenu" data-toggle="collapse" data-target="#productmenu"> <i class="ti-user"></i><span class="d-none d-sm-inline">Product Management</span><i class="fa fa-table"></i></a>
                <div class="collapse {{  request()->routeIs('seller.products.*') ? 'show' : '' }}" id="productmenu" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">

                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('seller.products.index') ? 'active' : '' }} {{  request()->routeIs('seller.products.show') ? 'active' : '' }} {{  request()->routeIs('seller.products.edit') ? 'active' : '' }} " href="{{ route('seller.products.index') }}" style="padding-left:33px;">My Products</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('seller.products.create') ? 'active' : '' }}" href="{{ route('seller.products.create') }}" style="padding-left:33px;">Add New Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('seller.products.importproducts') ? 'active' : '' }}" href="{{ route('seller.products.importproducts') }}" style="padding-left:33px;">Import Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{  request()->routeIs('seller.products.uploadfile') ? 'active' : '' }}" href="{{ route('seller.products.uploadfile') }}" style="padding-left:33px;">Upload Products</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            
            <li class="nav-item">
                <a class="nav-link collapsed text-truncate" href="#customermenu" data-toggle="collapse" data-target="#customermenu"> <i class="ti-user"></i><span class="d-none d-sm-inline">Customer Management</span><i class="fa fa-table"></i></a>
                <div class="collapse {{  request()->routeIs('user.customermanagement.*') ? 'show' : '' }}" id="customermenu" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">

                        @hasanyrole('Admin|Moderator')
                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('user.customermanagement.mycustomer.invite.index') ? 'active' : '' }}" href="{{ route('user.customermanagement.mycustomer.invite.index') }}" style="padding-left:33px;">Invite Customer</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('user.customermanagement.mycustomer.customerinvited') ? 'active' : '' }}" href="{{ route('user.customermanagement.mycustomer.customerinvited') }}" style="padding-left:33px;">Invited Customers</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('user.customermanagement.newcustomerindex') ? 'active' : '' }}" href="{{ route('user.customermanagement.newcustomerindex') }}" style="padding-left:33px;">New Customer</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link {{  request()->routeIs('user.customermanagement.mycustomer.customerReassign') ? 'active' : '' }}" href="{{ route('user.customermanagement.mycustomer.customerReassign') }}" style="padding-left:33px;">Re-assign Customer</a>
                        </li>
                        @endhasanyrole
    
                        <li class="nav-item">
                            <a class="nav-link  {{  request()->routeIs('user.customermanagement.mycustomer.index') ? 'active' : '' }}  {{  request()->routeIs('user.customermanagement.mycustomer.manage') ? 'active' : '' }}  {{  request()->routeIs('user.customermanagement.mycustomer.detials') ? 'active' : '' }}" href="{{ route('user.customermanagement.mycustomer.index')}}"  style="padding-left:33px;">My Customer</a>
                        </li>
                    </ul>
                </div>
            </li>
    
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
                <div class="collapse  {{  request()->routeIs('seller.quote.*') ? 'show' : '' }}" id="quotationmenu" aria-expanded="false">
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
    