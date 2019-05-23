<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
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
            <li class="{{ Request::is('admin/product-image') || Request::is('admin/product-image/*') ? "active" : "" }}">
                <a href="/admin/product-image">
                <i class="fa fa-photo"></i>
                    <span>Product Image</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/courier') || Request::is('admin/courier/*') ? "active" : "" }}">
                <a href="/admin/courier">
                <i class="fa fa-group"></i>
                    <span>Courier</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>