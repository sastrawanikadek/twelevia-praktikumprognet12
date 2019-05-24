<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @isset(Auth::user()->email)
                <li class="{{ Request::is('home') ? "active" : "" }}">
                    <a href="/home">
                    <i class="fa fa-dashboard"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="/shop">
                    <i class="fa fa-shopping-bag"></i>
                        <span>Shop</span>
                    </a>
                </li>
                <li class="{{ Request::is('profile') ? "active" : "" }}">
                    <a href="/profile">
                    <i class="fa fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @else
                <li class="{{ Request::is('admin/dashboard') ? "active" : "" }}">
                    <a href="/admin/dashboard">
                    <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category') || Request::is('admin/category/*') ? "active" : "" }}">
                    <a href="/admin/category">
                    <i class="fa fa-folder"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/product') || Request::is('admin/product/*') ? "active" : "" }}">
                    <a href="/admin/product">
                    <i class="fa fa-shopping-cart"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/courier') || Request::is('admin/courier/*') ? "active" : "" }}">
                    <a href="/admin/courier">
                    <i class="fa fa-group"></i>
                        <span>Courier</span>
                    </a>
                </li>
            @endisset
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>