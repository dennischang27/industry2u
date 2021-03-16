<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">admin panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        e-commerce
    </div>

    <!-- Nav Item - Products Collapse Menu -->
    <li class="nav-item {{  request()->routeIs('admin.ecommerce.*') ? 'active' : '' }}">
        <a class="nav-link {{  request()->routeIs('admin.ecommerce.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseecommrce"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Product</span>
        </a>
        <div id="collapseecommrce" class="collapse {{  request()->routeIs('admin.ecommerce.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.ecommerce.productcategories.*') ? 'active' : '' }}" href="{{ route('admin.ecommerce.productcategories.index') }}"><i class="fas fa-fw fa-archive"></i> Categories</a>
                <a class="collapse-item {{  request()->routeIs('admin.ecommerce.brands.*') ? 'active' : '' }}" href="{{ route('admin.ecommerce.brands.index') }}"><i class="fas fa-fw fa-ticket-alt"></i> Brands</a>
                <a class="collapse-item {{  request()->routeIs('admin.ecommerce.attributes.*') ? 'active' : '' }}" href="{{ route('admin.ecommerce.attributes.index') }}"><i class="fas fa-glass-martini"></i> Attributes</a>
                <a class="collapse-item {{  request()->routeIs('admin.ecommerce.products.*') ? 'active' : '' }}" href="{{ route('admin.ecommerce.products.index') }}"><i class="fas fa-fw fa-shopping-bag"></i> Products</a>
                <!--a class="collapse-item {{  request()->routeIs('admin.ecommerce.productsImport') ? 'active' : '' }}" href="{{ route('admin.ecommerce.productsImport') }}"><i class="fas fa-fw fa-shopping-bag"></i> Import Products</a-->
            </div>
        </div>
    </li>
    <!-- Nav Item - Transaction Collapse Menu -->
    <!--li class="nav-item {{  request()->routeIs('admin.transaction.*') ? 'active' : '' }}">
        <a class="nav-link {{  request()->routeIs('admin.transaction.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsetransaction"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Transactions</span>
        </a>
        <div id="collapsetransaction" class="collapse {{  request()->routeIs('admin.transactions.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.transactions.ir.*') ? 'active' : '' }}" href="{{ route('admin.transactions.ir.index') }}"><i class="fas fa-fw fa-archive"></i> Item Request</a>

            </div>
        </div>
    </li-->

    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item {{  request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link {{  request()->routeIs('admin.users.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseusers"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Users</span>
        </a>
        <div id="collapseusers" class="collapse {{  request()->routeIs('admin.users.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.users.users.*') ? 'active' : '' }}" href="{{ route('admin.users.users.index') }}"><i class="fas fa-fw fa-user"></i> Users</a>
                <a class="collapse-item {{  request()->routeIs('admin.users.roles.*') ? 'active' : '' }}" href="{{ route('admin.users.roles.index') }}"><i class="fas fa-fw fa-users"></i> Roles</a>
                <a class="collapse-item {{  request()->routeIs('admin.users.departments.*') ? 'active' : '' }}" href="{{ route('admin.users.departments.index') }}"><i class="fas fa-fw fa-users"></i> Departments</a>
                <a class="collapse-item {{  request()->routeIs('admin.users.permissions.*') ? 'active' : '' }}" href="{{ route('admin.users.permissions.index') }}"><i class="fas fa-fw fa-id-badge"></i> Permissions</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item {{  request()->routeIs('admin.companies.*') ? 'active' : '' }}">
        <a class="nav-link {{  request()->routeIs('admin.companies.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsecompanies"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Companies</span>
        </a>
        <div id="collapsecompanies" class="collapse {{  request()->routeIs('admin.companies.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.companies.*') ? 'active' : '' }}" href="{{ route('admin.companies.index') }}"><i class="fas fa-fw fa-briefcase"></i> Companies</a>

            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item {{  request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <a class="nav-link {{  request()->routeIs('admin.settings.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsesettings"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Settings</span>
        </a>
        <div id="collapsesettings" class="collapse {{  request()->routeIs('admin.settings.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{  request()->routeIs('admin.settings.industry.*') ? 'active' : '' }}" href="{{ route('admin.settings.industry.index') }}"><i class="fas fa-fw fa-industry"></i> Industries</a>
                <a class="collapse-item {{  request()->routeIs('admin.settings.companybudget.*') ? 'active' : '' }}" href="{{ route('admin.settings.companybudget.index') }}"><i class="fas fa-fw fa-wallet"></i> Company Budgets</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{route("admin.clear-cache")}}">
            <i class="fas fa-fw fa-sync-alt" aria-hidden="true"></i>
            <span>Clear Cache</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
