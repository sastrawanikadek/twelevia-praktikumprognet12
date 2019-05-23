<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo"  style="background-color: #1abc9c;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TV</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Twelevia</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="background-color: #1abc9c;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <form action="/logout/admin" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-flat" style="padding: 14px 14px; background-color: transparent; color: white;">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>