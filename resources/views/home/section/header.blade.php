<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="{{ route('page-detail','help-and-faq') }}" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    @auth
                        <a href="{{ route(auth()->user()->role) }}" class="flex-c-m trans-04 p-lr-25">
                            My Account
                        </a>
                    @else
                            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                Login
                            </a>
                            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                Register
                            </a>
                        @endauth
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('homepage') }}" class="logo">
                    <img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('homepage') }}">Home</a>
                        </li>

                        <li>
                            <a href="{{ route('all-products') }}">Shop</a>
                        </li>

                        {{ getCategoryMenu() }}

                        <li class="label1" data-label1="hot">
                            <a href="{{ route('featured-products') }}">Features</a>
                        </li>


                        <li>
                            <a href="{{ route('page-detail','about-us') }}">About</a>
                        </li>

                        <li>
                            <a href="{{ route('contact-us') }}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="fa fa-search"></i>
                    </div>
                    @php
                        $total_prod =0;
                        if(session('cart')){
                            foreach (session('cart') as $cart_items){
                                $total_prod += $cart_items['quantity'];
                            }
                        }
                    @endphp

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="{{ $total_prod }}">
                        <i class="fa fa-shopping-cart"></i>
                    </div>


                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <a href="{{ route('homepage') }}" class="logo">
            <img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">
        </a>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="fa fa-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="{{ $total_prod }}">
                <i class="fa fa-shopping-cart"></i>
            </div>


        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">

                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.html">Home</a>

                <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
            </li>

            <li>
                <a href="product.html">Shop</a>
            </li>

            <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
            </li>


            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" method="get" action="{{ route('search') }}">
                <button class="flex-c-m trans-04">
                    <i class="fa fa-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search..." value="{{ isset(request()->search) ? request()->search : '' }}">
            </form>
        </div>
    </div>
</header>
