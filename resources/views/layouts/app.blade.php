<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fav Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('gymer/assets/img/fav-icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="gymer/assets/img/fav-icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="gymer/assets/img/fav-icons/favicon-16x16.png">

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/fontawesome/css/fontawesome-all.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/flaticon/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/owl.carousel/css/owl.carousel.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/owl.carousel/css/owl.theme.default.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/magnific-popup/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/animate.css/css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/slick-carousel/css/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/slick-carousel/css/slick-theme.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/material-design-icons/css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/rs-plugin/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('gymer/dependencies/rangeslider.js/css/rangeslider.css') }}">
    <script src="https://js.braintreegateway.com/web/dropin/1.37.0/js/dropin.min.js"></script>


    <!-- Google Web Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900%7CRoboto:300,400,500,700,900"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('gymer/assets/css/app.css') }}" type="text/css">

    <link id="theme" rel="stylesheet" href="{{ asset('assets/css/theme-color/theme-default.css') }}"
        type="text/css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stack('style')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
        @media (max-width: 767px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="site">
            <header id="header" class="header_area hdr_area_two hdr_area_four">
                <!-- Start top toolbar -->
                <section class="top_toolbar top_toolbar_new">
                    <div class="vigo_container_one">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="toolbar_left">
                                    <p>Welcome to liveWellWorld</p>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="toolbar_right">
                                    <ul>

                                        <li class="cart">
                                            <i class="fas fa-shopping-basket"></i>
                                            <div class="cart_detail">
                                                @foreach ($cartItemsGlobal as $cartItem)

                                                    <div class="single_cart">
                                                        <div class="cart_left">
                                                            <img src="/upload/{{ $cartItem->product->image }}"
                                                                alt="">
                                                        </div>
                                                        <div class="cart_right">
                                                            <h3>{{ $cartItem->product->name }} x {{ $cartItem->quantity }}</h3>
                                                            <p>${{ $cartItem->product->price }}<sup>USD</sup></p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                @if (!$cartItemsGlobal)
                                                    <div class="cart_more">
                                                        <a href="/shop">YOUR CART IS EMPTY CONTINUE SHOPPING<i
                                                                class="fa fa-angle-right"></i></a>
                                                    </div>
                                                @endif

                                                <div class="cart_more">
                                                    <a href="/cart">View Cart <i class="fa fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="phone">
                                            <a tel:+27 72 154 7121>
                                                <i class="fas fa-phone"></i>
                                                Call +263 71 284 5358
                                            </a>
                                        </li>
                                        <li>
                                            <a tel:+27 72 154 7121>
                                                <i class="fas fa-phone"></i>
                                                Call +27 72 154 7121
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End top toolbar -->

                <!-- Start Main Menu -->
                <section class="header_nav">
                    <div class="vigo_container_one">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <div class="header_logo">
                                    <a href="/">
                                        <img class="logo-default" src="{{ asset('logo.png') }}" alt=""
                                            style="height:90px;">
                                        <img class="logo-white" src="{{ asset('logo.png') }}" style="height:90px;"
                                            alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto no-position">
                                <nav class="main_menu">
                                    <ul id="example-one">
                                        <li>
                                            <a class="current_page_item active" href="/">Home</a>

                                        </li>
                                        <li>
                                            <a href="/posts">blog</a>

                                        </li>
                                        <li>
                                            <a href="/shop">Shop</a>

                                        </li>

                                        @guest
                                            @if (Route::has('login'))
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>
                                            @endif

                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif
                                        @else
                                            <li>
                                                <a href="/home">My Account</a>

                                            </li>
                                            <li>
                                                <a href="/cart">Your Cart</a>

                                            </li>
                                            <li>
                                                <a class="current_page_item active"
                                                    href="#">{{ Auth::user()->name }} <span
                                                        class=""></span></a>
                                                <ul class="sub-menu">
                                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </li>

                                                </ul>
                                            </li>

                                        @endguest
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-auto">

                            </div>
                        </div>
                    </div>
                    <div class="search_detail_two">
                        <form action="#">
                            <input type="text" placeholder="Search Your key...">
                            <button><i class="material-icons">
                                    search
                                </i>
                            </button>
                        </form>
                        <div class="search_detail_two_close">
                            <i class="material-icons">
                                clear
                            </i>
                        </div>
                    </div>
                </section>
                <!-- End Main Menu -->

                <!-- Start Mobile Menu outer-->
                <section id="mobile-nav-wrap" class="clearfix">
                    <div class="mobile_toolbar">
                        <div class="vigo_container_one">
                            <div class="top_toolbar_right">
                                <div class="phone_number" >
                                    <span class="flaticon-phone-call"></span> <a tel="#" style="color: white">+263 71 284 5358</a>
                                </div>
                                <div class="header_login">
                                    <div class="whc_toolbar_main_login">
                                        @guest
                                        <a href="/register">register</a>|
                                        <a href="/login">login</a>
                                            @else
                                            <a href="/home">My Account</a>
                                        @endguest
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="vigo_container_one">
                        <div class="bottom_nav bottom_nav_two">
                            <div id="mobile-logo">
                                <a href="/">
                                    <img src="{{ asset('logo.png') }}" alt="" style="height:90px;">
                                </a>
                            </div>
                            <div class="toggle-inner">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Mobile Menu outer-->
            </header>

            <section class="mobile-menu-inner mobile-menu-inner-two">
                <div class="mobile_accor_togo">
                    <div class="mobile_accor_logo">
                        <a href="/">
                            <img src="{{ asset('logo.png') }}" class="svg" alt=""style="height:50px;">
                        </a>
                    </div>
                    <div class="close-menu">
                        <span></span>
                    </div>
                </div>
                <nav id="accordian">
                    <ul class="accordion-menu">
                        <li class="current_page_item">
                            <a href="/">Home</a>

                        </li>
                        <li>
                            <a href="/blog">Blog</a>
                        </li>
                        <li>
                            <a href="/shop">Shop</a>
                        </li>
                        <li>
                            <a href="/cart">My Shopping Cart</a>
                        </li>

                            <li><a  href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}"
                                      method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>



                    </ul>
                </nav>

            </section>
            <!-- End Mobile Menu inner-->
            <div>
                @if (\Session::has('message'))
                    <br>
                    <br>
                    <br>
                    <br>
                    <br> <br>
                    <div class="container">
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <div class="alert alert-danger">

                            <li>{{ $errors->first() }}</li>

                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- Start Footer -->
            <footer class="footer_five_area">
                <div class="vigo_container_one">
                    <div class="footer_five_top">
                        <div class="footer_five_top_left">
                            <a href="/" class="logo">
                                <img src="{{ asset('logo.png') }}" style="height:100px;" alt="">
                            </a>
                        </div>
                        <div class="footer_five_top_right">
                            <form action="#">
                                <label>
                                    <i class="fas fa-arrow-down"></i>
                                    <span>CHAT TO US IN OUR LIVE CHAT TO YOUR BOTTOM RIGHT.</span>
                                </label>
{{--                                <input type="text" placeholder="type your email here...">--}}
                                <button>
                                    <i class="material-icons">
                                        send
                                    </i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="footer_five_middle clearfix">
                        <div class="widget widget5">
                            <div class="widget5_about">
                                <p>60 Lorrein drive, bluffhill Harare</p>
                            </div>
                            {{-- <div class="widget5_social">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-medium-m"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-tumblr"></i>
                                </a>
                            </div> --}}
                        </div>

                        <div class="widget widget5">
                            <div class="widget5_title">
                                <h3>USEFUL LINKS</h3>
                            </div>
                            <div class="widget5_desc">
                                <a href="/shop">
                                    <i class="fas fa-caret-right"></i>
                                   Shop
                                </a>
                                <a href="/home">
                                    <i class="fas fa-caret-right"></i>
                                   Account
                                </a>
                                <a href="/posts">
                                    <i class="fas fa-caret-right"></i>
                                    Blog
                                </a>
                                <a href="/cart">
                                    <i class="fas fa-caret-right"></i>
                                    My Cart
                                </a>

                            </div>
                        </div>

                        {{-- <div class="widget widget5">
                            <div class="widget5_title">
                                <h3>other LInks</h3>
                            </div>
                            <div class="widget5_tweet">
                                <div id="twitter_feed"></div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="footer_five_bottom">
                        <div class="footer_four_bottom_left">
                            <p>Copyright© <a href="https://designave.co.zw">Designave</a> | All Rights Reserved</p>
                        </div>
                        <div class="footer_four_bottom_right">
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/visa.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/american-express.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/discover.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/paypal.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/stripe.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/nettler.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('gymer/media/images/home6/payoneer.png')}}" alt="">
                            </a>
                        </div>
                        <div class="backtotop">
                            <i class="fas fa-angle-double-up"></i>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- End Main content -->
        </div>
    </div>
    @livewireScripts
    <script src="{{ asset('gymer/dependencies/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/isotope-layout/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/slick-carousel/js/slick.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/jquery.countdown/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/gmap3/gmap3.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/headroom/js/headroom.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/countUp.js/js/countUp.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/twitter-fetcher/js/twitterFetcher_min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/aos/js/aos.js') }}"></script>
    <!-- <script async src="../../../platform.twitter.com/widgets.js" charset="utf-8"></script>
 <script async src="../../../cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc"></script>
    <script src="{{ asset('gymer/dependencies/rangeslider.js/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('gymer/dependencies/waypoints/js/jquery.waypoints.min.js') }}"></script>
    <!-- Site Scripts -->
    <script src="{{ asset('gymer/assets/js/middle.js') }}"></script>
    <script src="{{ asset('gymer/assets/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
