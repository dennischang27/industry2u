<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Products
    </div>

    <!-- Nav Item - Categories Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{  request()->routeIs('admin.productcategories.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsecategories"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Categories</span>
        </a>
        <div id="collapsecategories" class="collapse {{  request()->routeIs('admin.productcategories.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.productcategories.index') ? 'active' : '' }}" href="{{ route('admin.productcategories.index') }}">View</a>
                <a class="collapse-item {{  request()->routeIs('admin.productcategories.create') ? 'active' : '' }}" href="{{ route('admin.productcategories.create') }}">Add New</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Bands Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{  request()->routeIs('admin.brands.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsebrands"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Brands</span>
        </a>
        <div id="collapsebrands" class="collapse {{  request()->routeIs('admin.brands.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.brands.index') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">View</a>
                <a class="collapse-item {{  request()->routeIs('admin.brands.create') ? 'active' : '' }}" href="{{ route('admin.brands.create') }}">Add New</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Products Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{  request()->routeIs('admin.products.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseproducts"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Products</span>
        </a>
        <div id="collapseproducts" class="collapse {{  request()->routeIs('admin.products.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">View</a>
                  </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
