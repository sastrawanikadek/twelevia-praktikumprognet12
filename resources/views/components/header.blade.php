<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="/">Twelevia</a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="#">Shop</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Women's Collection</li>
                                    <li><a href="/shop/Women/Dresses">Dresses</a></li>
                                    <li><a href="/shop/Women/Blouses & Shirts">Blouses &amp; Shirts</a></li>
                                    <li><a href="/shop/Women/T-shirts">T-shirts</a></li>
                                    <li><a href="/shop/Women/Rompers">Rompers</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="/shop/Men/T-Shirts">T-Shirts</a></li>
                                    <li><a href="/shop/Men/Polo">Polo</a></li>
                                    <li><a href="/shop/Men/Shirts">Shirts</a></li>
                                    <li><a href="/shop/Men/Jackets">Jackets</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="/shop/Kid/Dresses">Dresses</a></li>
                                    <li><a href="/shop/Kid/Shirts">Shirts</a></li>
                                    <li><a href="/shop/Kid/T-shirts">T-shirts</a></li>
                                    <li><a href="/shop/Kid/Jackets">Jackets</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="{{ asset("img/bg-6.jpg") }}" alt="">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                <a href="#"><img src="{{ asset("img/heart.svg") }}" alt=""></a>
            </div>
            <!-- User Login Info -->
            <div class="user-login-info">
                <a href="/login"><img src="{{ asset("img/user.svg") }}" alt=""></a>
            </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="{{ asset("img/bag.svg") }}" alt=""> <span>{{ isset($quantity) ? $quantity : '' }}</span></a>
            </div>
        </div>

    </div>
</header>
<!-- ##### Header Area End ##### -->