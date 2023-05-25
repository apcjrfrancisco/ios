<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier') }}">
                <i class="fas fa-user-friends menu-icon"></i>
                <span class="menu-title">Manage Suppliers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('unit') }}">
                <i class="far fa-clipboard menu-icon"></i>
                <span class="menu-title">Manage Units</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category') }}">
                <i class="fas fa-sitemap menu-icon"></i>
                <span class="menu-title">Manage Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('brand') }}">
                <i class="fas fa-server menu-icon"></i>
                <span class="menu-title">Manage Brands</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products" href="{{ route('product') }}">
                <i class="far fa-file-alt menu-icon"></i>
                <span class="menu-title">Manage Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
                <i class="fa-solid fa-folder-open menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('purchase') }}"> All Purchases </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('purchase.pending') }}"> Pending Purchases
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('orders') }}"> All Orders </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('stock.report') }}"> Stock Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('stock.supplier.wise') }}"> Supplier / Product Wise </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="fa-solid fa-gear menu-icon"></i>
                <span class="menu-title">Site Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('slider') }}">Sliders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.setting') }}">Footer Setting</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}">
                <i class="fas fa-home menu-icon"></i>
                <span class="menu-title">Go To eTorrecamps</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="fas fa-user-check menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
