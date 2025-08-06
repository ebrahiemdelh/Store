<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }} " />
    <title>{{ $title }}</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->
    <!-- Start Header Area -->
    <header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <ul class="menu-top-link">
                                <li>
                                    <div class="select-position">
                                        <form action="{{ route('currency.store') }}" method="post">
                                            @csrf
                                            <select name="currency_code" onchange="this.form.submit()">
                                                <option value="USD" @selected("USD" === session('currency_code'))>$ USD
                                                </option>
                                                <option value="EUR" @selected("EUR" === session('currency_code'))>€ EURO
                                                </option>
                                                <option value="EGP" @selected("EGP" === session('currency_code'))>ج.م EGP
                                                </option>
                                                <option value="SAR" @selected("SAR" === session('currency_code'))>ر.س SAR
                                                </option>
                                                <option value="CNY" @selected("CNY" === session('currency_code'))>¥ CNY
                                                </option>
                                                <option value="BDT" @selected("BDT" === session('currency_code'))>৳ BDT
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="select-position">
                                        <form action="{{ URL::current() }}" method="get">
                                            <select id="select5" name="locale" onchange="this.form.submit()">
                                                @foreach (config('app.available_locales') as $language => $code)
                                                    <option value="{{ $code }}" @selected($code === session('locale'))>
                                                        @lang($language)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                                <li><a href="about-us.html">@lang('About Us')</a></li>
                                <li><a href="contact.html">@lang('Contact Us')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">
                            @auth
                                <a class="user"
                                    href="{{ 
                                                Config::get('fortify.gaurd') == 'admin' ? route('dashboard.dash') : route('dash') }}">
                                    <i class="lni lni-user"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="user-login">
                                    <li style="border-right:none;">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();  document.getElementById('logout').submit();">@lang('Log Out')</a>
                                    </li>
                                    <form id="logout" action="{{ route('logout') }}" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            @else
                            <div class="user">
                                <i class="lni lni-user"></i>
                                @lang('Hello')
                            </div>
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('login') }}">@lang('Sign In')</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">@lang('Register')</a>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Start Header Middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-7">
                        <!-- Start Header Logo -->
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo">
                        </a>
                        <!-- End Header Logo -->
                    </div>
                    <div class="col-lg-5 col-md-7 d-xs-none">
                        <!-- Start Main Menu Search -->
                        <div class="main-menu-search">
                            <!-- navbar search start -->
                            <div class="navbar-search search-style-5">
                                <div class="search-select">
                                    <div class="select-position">
                                        <select id="select1">
                                            <option selected>@lang('All')</option>
                                            <option value="1">@lang('option 01')</option>
                                            <option value="2">@lang('option 02')</option>
                                            <option value="3">@lang('option 03')</option>
                                            <option value="4">@lang('option 04')</option>
                                            <option value="5">@lang('option 05')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="search-input">
                                    <input type="text" placeholder="@lang('Search')">
                                </div>
                                <div class="search-btn">
                                    <button><i class="lni lni-search-alt"></i></button>
                                </div>
                            </div>
                            <!-- navbar search Ends -->
                        </div>
                        <!-- End Main Menu Search -->
                    </div>
                    <div class="col-lg-4 col-md-2 col-5">
                        <div class="middle-right-area">
                            <div class="nav-hotline">
                                <i class="lni lni-phone"></i>
                                <h3>@lang('Hotline:')
                                    <span>(+20) 106 285 9646</span>
                                </h3>
                            </div>
                            <div class="navbar-cart">
                                <div class="wishlist">
                                    <a href="javascript:void(0)">
                                        <i class="lni lni-heart"></i>
                                        <span class="total-items">0</span>
                                    </a>
                                </div>
                                <x-cart-menu />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Middle -->
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                        <div class="mega-category-menu">
                            <span class="cat-button"><i class="lni lni-menu"></i>@lang('All Categories')</span>
                            <ul class="sub-category">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('front.products.showgrids') }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="index.html" class="active"
                                            aria-label="Toggle navigation">@lang('Home')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">@lang('Pages')</a>
                                        <ul class="sub-menu collapse" id="submenu-1-2">
                                            <li class="nav-item"><a href="about-us.html">@lang('About Us')</a></li>
                                            <li class="nav-item"><a href="faq.html">@lang('Faq')</a></li>
                                            <li class="nav-item"><a href="{{ route('login') }}">@lang('Login')</a></li>
                                            <li class="nav-item"><a href="{{ route('register') }}">@lang('Register')</a>
                                            </li>
                                            <li class="nav-item"><a href="mail-success.html">@lang('Mail Success')</a>
                                            </li>
                                            <li class="nav-item"><a href="#">@lang('404 Error')</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">@lang('Shop')</a>
                                        <ul class="sub-menu collapse" id="submenu-1-3">
                                            <li class="nav-item"><a
                                                    href="{{ route('front.products.showgrids') }}">@lang('Shop Grid')</a>
                                            </li>
                                            <li class="nav-item"><a href="product-list.html">@lang('Shop List')</a></li>
                                            <li class="nav-item"><a href="product-details.html">@lang('Shop Single')</a>
                                            </li>
                                            <li class="nav-item"><a href="cart.html">@lang('Cart')</a></li>
                                            <li class="nav-item"><a href="checkout.html">@lang('Checkout')</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">@lang('Blog')</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item"><a
                                                    href="blog-grid-sidebar.html">@lang('Blog Grid Sidebar')</a>
                                            </li>
                                            <li class="nav-item"><a href="blog-single.html">@lang('Blog Single')</a>
                                            </li>
                                            <li class="nav-item"><a
                                                    href="blog-single-sidebar.html">@lang('Blog Single Sidebar')</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="contact.html" aria-label="Toggle navigation">@lang('Contact Us')</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Nav Social -->
                    <div class="nav-social">
                        <h5 class="title">@lang('Follow Us')</h5>
                        <ul>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Nav Social -->
                </div>
            </div>
        </div>
        <!-- End Header Bottom -->
    </header>
    <!-- End Header Area -->
    <!-- Start Breadcrumbs -->
    {{ $breadcrumbs }}
    <!-- End Breadcrumbs -->


    {{ $slot }}


    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="footer-logo single-footer">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/logo/white-logo.svg') }}" alt="#">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>@lang('Get In Touch With Us')</h3>
                                <p class="phone">@lang('Phone'): +1 (900) 33 169 7720</p>
                                <ul>
                                    <li><span>@lang('Monday-Friday'): </span> 9.00 am - 8.00 pm</li>
                                    <li><span>@lang('Saturday'): </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>@lang('Information')</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">@lang('About Us')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Contact Us')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Downloads')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Sitemap')</a></li>
                                    <li><a href="javascript:void(0)">@lang('FAQs Page')</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>@lang('Shop Departments')</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">@lang('Computers & Accessories')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Smartphones & Tablets')</a></li>
                                    <li><a href="javascript:void(0)">@lang('TV, Video & Audio')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Cameras, Photo & Video')</a></li>
                                    <li><a href="javascript:void(0)">@lang('Headphones')</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>@lang('We Accept:')</span>
                                <img src="{{ asset('assets/images/footer/credit-cards-footer.png') }}" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>@lang('Designed and Developed by') <a href="https://graygrids.com/" rel="nofollow"
                                        target="_blank">@lang('GrayGrids')</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="socila">
                                <li>
                                    <span>@lang('Follow Us On:')</span>
                                </li>
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!--/ End Footer Area -->
    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>