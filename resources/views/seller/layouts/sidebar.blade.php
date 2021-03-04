<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('seller.dashboard') }}"><img src="{{ asset('images/industry2u_100.png') }}" alt="industry2u"> <span style="font-size: 14px;">Supplier Centre</span></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{  request()->routeIs('seller.products.*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="{{  request()->routeIs('seller.products.*') ? 'true' : 'false' }}">
                            <i class="ti-package"></i>
                            <span>Products</span>
                        </a>
                        <ul class="collapse {{  request()->routeIs('seller.products.*') ? 'in' : '' }}">
                            <li class="{{  request()->routeIs('seller.products.index') ? 'active' : '' }}"><a href="{{ route('seller.products.index') }}">My Products</a></li>
                            <li class="{{  request()->routeIs('seller.products.create') ? 'active' : '' }}"><a href="{{ route('seller.products.create') }}">Add New Product</a></li>
                            <li class="{{  request()->routeIs('seller.products.importproducts') ? 'active' : '' }}"><a href="{{ route('seller.products.importproducts') }}">Import Products</a></li>
                            <li class="{{  request()->routeIs('seller.products.uploadfile') ? 'active' : '' }}"><a href="{{ route('seller.products.uploadfile') }}">Upload Files</a></li>
                        </ul>
                    </li>

                    <li class="{{  request()->routeIs('seller.account') ? 'active' : '' }} {{  request()->routeIs('seller.company.*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-map-alt"></i>
                            <span>Company</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{  request()->routeIs('seller.company.profile') ? 'active' : '' }} {{  request()->routeIs('seller.company.profile.*') ? 'active' : '' }}"><a href="{{ route('seller.company.profile') }}">Company Profile</a></li>
                            <!--li class="{{  request()->routeIs('seller.account') ? 'active' : '' }}"><a href="{{ route('seller.account') }}">Account</a></li-->
                        </ul>

                        @hasanyrole('Admin|Moderator')

                        <ul class="collapse">
                            <li class="{{  request()->routeIs('seller.discount*') ? 'active' : '' }} {{  request()->routeIs('seller.discount.*') ? 'active' : '' }}"><a href="{{ route('seller.discount.index') }}">Discount Setting</a></li>
                            <ul>
                                <li class="{{  request()->routeIs('seller.discount.masters') ? 'active' : '' }} {{  request()->routeIs('seller.company.discount.*') ? 'active' : '' }}"><a href="{{ route('seller.discount.masters') }}">Master</a></li>
                                <li class="{{  request()->routeIs('seller.discount.manager') ? 'active' : '' }} {{  request()->routeIs('seller.company.discount.*') ? 'active' : '' }}"><a href="{{ route('seller.discount.manager') }}">Manager</a></li>
                                <li class="{{  request()->routeIs('seller.discount.sales') ? 'active' : '' }} {{  request()->routeIs('seller.company.discount.*') ? 'active' : '' }}"><a href="{{ route('seller.discount.sales') }}">Sales</a></li>

                            </ul>  
                        </ul>
                        @endhasanyrole
                    </li>
                   
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
