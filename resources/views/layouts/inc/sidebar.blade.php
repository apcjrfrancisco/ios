<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="nav1" href="{{ route('supplier.all') }}">
                <i class="fas fa-user-friends menu-icon"></i>
                <span class="menu-title">Manage Suppliers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('unit.all') }}">
                <i class="far fa-clipboard menu-icon"></i>
                <span class="menu-title">Manage Units</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.all') }}">
                <i class="fas fa-sitemap menu-icon"></i>
                <span class="menu-title">Manage Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('brand.all') }}">
                <i class="fas fa-server menu-icon"></i>
                <span class="menu-title">Manage Brands</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.all') }}">
                <i class="far fa-file-alt menu-icon"></i>
                <span class="menu-title">Manage Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="auth">
                <i class="fa-solid fa-folder-open menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('purchase.all') }}"> All Purchases </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('purchase.pending')}}"> Pending Purchases </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('orders') }}"> All Orders </a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a> --}}
                    </li>
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
                    <li class="nav-item"> <a class="nav-link" href="{{ route('slider.all') }}">Sliders</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('purchase.pending')}}"> Pending Purchases </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a> --}}
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
            <a class="nav-link" href="pages/icons/mdi.html">
                <i class="mdi mdi-emoticon menu-icon"></i>
                <span class="menu-title">Icons</span>
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
