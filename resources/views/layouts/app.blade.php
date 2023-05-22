<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fav Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('gymer/assets/img/fav-icons/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="gymer/assets/img/fav-icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="gymer/assets/img/fav-icons/favicon-16x16.png">

	<!-- Dependency Styles -->
	<link rel="stylesheet" href="{{asset('gymer/dependencies/bootstrap/css/bootstrap.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/fontawesome/css/fontawesome-all.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/flaticon/css/flaticon.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/owl.carousel/css/owl.carousel.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/owl.carousel/css/owl.theme.default.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/magnific-popup/magnific-popup.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/animate.css/css/animate.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/slick-carousel/css/slick.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/slick-carousel/css/slick-theme.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/material-design-icons/css/material-icons.css')}}">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/rs-plugin/css/settings.css')}}">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/aos/css/aos.css')}}">
	<link rel="stylesheet" href="{{asset('gymer/dependencies/rangeslider.js/css/rangeslider.css')}}">

	<!-- Google Web Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900%7CRoboto:300,400,500,700,900" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('gymer/assets/css/app.css')}}" type="text/css">

	<link id="theme" rel="stylesheet" href="{{asset('assets/css/theme-color/theme-default.css')}}" type="text/css">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

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
												<div class="single_cart">
													<div class="cart_left">
														<img src="{{asset('gymer/media/images/banner-two/cart-one.png')}}" alt="">
													</div>
													<div class="cart_right">
														<h3>Vaxin Regular Big Name</h3>
														<p>$66 <sup>USD</sup></p>
													</div>
												</div>
												<div class="single_cart">
													<div class="cart_left">
														<img src="{{asset('gymer/media/images/banner-two/cart-two.png')}}" alt="">
													</div>
													<div class="cart_right">
														<h3>Vaxin Woman</h3>
														<p>$76 <sup>USD</sup></p>
													</div>
												</div>
												<div class="cart_more">
													<a href="#">View Cart <i class="fa fa-angle-right"></i></a>
												</div>
											</div>
										</li>
										<li class="phone">
											<a href="#">
												<i class="fas fa-phone"></i>
												Call +263 772 123 456
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
									<a href="index.html">
										<img class="logo-default" src="media/images/home6/logo.png" alt="">
										<img class="logo-white" src="media/images/home6/footer-logo.png" alt="">
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
											<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
										</li>
										@endif

										@if (Route::has('register'))
										<li class="nav-item">
											<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
										</li>
										@endif
										@else
										<li>
											<a class="current_page_item active" href="index.html">{{ Auth::user()->name }} <span class=""></span></a>
											<ul class="sub-menu">
												<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
														{{ __('Logout') }}
													</a>

													<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
								<div class="phone_number">
									<span class="flaticon-phone-call"></span> <a href="#">+1 (895) 852–6523</a>
								</div>
								<div class="header_login">
									<div class="whc_toolbar_main_login">
										<a href="sign-up.html">register</a>|
										<a href="sign-in.html">login</a>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="vigo_container_one">
						<div class="bottom_nav bottom_nav_two">
							<div id="mobile-logo">
								<a href="index.html">
									<img src="assets/img/hm-two-logo.png" class="svg" alt="">
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
						<a href="index.html">
							<img src="assets/img/hm-two-logo.png" class="svg" alt="">
						</a>
					</div>
					<div class="close-menu">
						<span></span>
					</div>
				</div>
				<nav id="accordian">
					<ul class="accordion-menu">
						<li class="current_page_item">
							<a href="index.html" class="dropdownlink">Home</a>
							<ul class="submenuItems">
								<li><i class="flaticon-right-arrow-angle"></i><a href="index.html">Home One</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="index2.html">Home Two</a></li>
							</ul>
						</li>
						<li>
							<a href="supplement.html">Supplement</a>
						</li>
						<li>
							<a href="feature.html">Feature</a>
						</li>
						<li>
							<a href="collection.html" class="dropdownlink">Productlist</a>
							<ul class="submenuItems">
								<li><i class="flaticon-right-arrow-angle"></i><a href="collection.html">Productlist</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="collection-all.html">Product Sidebar</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="product-detail.html">Product Detail</a></li>
							</ul>
						</li>
						<li>
							<a href="ingredient.html">Ingredient</a>
						</li>
						<li>
							<a href="blog.html" class="dropdownlink">blog</a>
							<ul class="submenuItems">
								<li><i class="flaticon-right-arrow-angle"></i><a href="blog.html"> Blog</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="blog-details.html"> Blog details</a></li>
							</ul>
						</li>
						<li>
							<a href="contact.html" class="dropdownlink">Contact</a>
							<ul class="submenuItems">
								<li><i class="flaticon-right-arrow-angle"></i><a href="contact.html">Contact page</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="about.html">About us</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="privacy.html">Privacy</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="reset-pass.html">Reset Pass</a></li>
								<li><i class="flaticon-right-arrow-angle"></i><a href="faq.html">FAQ</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				<form action="#" id="moble-search">
					<input type="text" placeholder="Search....">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
				<ul class="footer-social-link">
					<li class="fb-bg"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li class="in-bg"><a href="#"><i class="fab fa-instagram"></i></a></li>
					<li class="tw-bg"><a href="#"><i class="fab fa-twitter"></i></a></li>
					<li class="gp-bg"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
				</ul>
			</section>
			<!-- End Mobile Menu inner-->
			<div>
				@yield('content')
			</div>
			<!-- Start Footer -->
			<footer class="footer_five_area">
			<div class="vigo_container_one">
				<div class="footer_five_top">
					<div class="footer_five_top_left">
						<a href="#" class="logo">
					<img src="media/images/home6/footer-logo.png" alt="#">
				</a>
					</div>
					<div class="footer_five_top_right">
						<form action="#">
							<label>
						<i class="fas fa-arrow-right"></i>
						<span>SUBSCRIBE TO OUR NEWSLETTER FOR OFFERS & PROMOTIONALS.</span>
					</label>
							<input type="text" placeholder="type your email here...">
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
							<p>Vaxin Internationals Ltd. Suite 109, Floor 5 240 New Canberra WA 1234, AUSTRALIA</p>
						</div>
						<div class="widget5_social">
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
						</div>
					</div>
					<div class="widget widget5">
						<div class="widget5_title">
							<h3>Company</h3>
						</div>
						<div class="widget5_desc">
							<a href="#">
						<i class="fas fa-caret-right"></i>
						About us
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Delivery Information
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Terms & Conditions
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Privacy Policy
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						FAQs
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Refund Policy
					</a>
						</div>
					</div>
					<div class="widget widget5">
						<div class="widget5_title">
							<h3>USEFUL LINKS</h3>
						</div>
						<div class="widget5_desc">
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Themes & Templates
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Delivery Information
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Terms & Conditions
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Privacy Policy
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						FAQs
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Refund Policy
					</a>
						</div>
					</div>
					<div class="widget widget5">
						<div class="widget5_title">
							<h3>from the feed</h3>
						</div>
						<div class="widget5_desc">
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Themes & Templates
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Delivery Information
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Terms & Conditions
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Privacy Policy
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						FAQs
					</a>
							<a href="#">
						<i class="fas fa-caret-right"></i>
						Refund Policy
					</a>
						</div>
					</div>
					<div class="widget widget5">
						<div class="widget5_title">
							<h3>other LInks</h3>
						</div>
						<div class="widget5_tweet">
							<div id="twitter_feed"></div>
						</div>
					</div>
				</div>
				<div class="footer_five_bottom">
					<div class="footer_four_bottom_left">
						<p>Copyright© <a href="#">ThemeIM</a> | All Rights Reserved</p>
					</div>
					<div class="footer_four_bottom_right">
						<a href="#">
					<img src="media/images/home6/visa.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/american-express.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/discover.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/paypal.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/stripe.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/nettler.png" alt="">
				</a>
						<a href="#">
					<img src="media/images/home6/payoneer.png" alt="">
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
	<script src="{{asset('gymer/dependencies/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/popper.js/popper.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/owl.carousel/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/isotope-layout/js/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/slick-carousel/js/slick.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/jquery.countdown/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/gmap3/gmap3.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/headroom/js/headroom.js')}}"></script>
	<script src="{{asset('gymer/dependencies/countUp.js/js/countUp.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/twitter-fetcher/js/twitterFetcher_min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/aos/js/aos.js')}}"></script>
	<!-- <script async src="../../../platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script async src="../../../cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc"></script>
	<script src="{{asset('gymer/dependencies/rangeslider.js/js/rangeslider.min.js')}}"></script>
	<script src="{{asset('gymer/dependencies/waypoints/js/jquery.waypoints.min.js')}}"></script>
	<!-- Site Scripts -->
	<script src="{{asset('gymer/assets/js/middle.js')}}"></script>
	<script src="{{asset('gymer/assets/js/app.js')}}"></script>
</body>

</html>