@extends('layouts.app')
@section('content')
    <!--==========================-->
    <!--=        Banner         =-->
    <!--==========================-->
    <section class="banner_static">
        <div class="vigo_container_one">
            <div class="banner_static_flex">
                <div class="banner_static_left">
                    <h1>
                        Live Well
                        <span>World</span>
                    </h1>
                    <div class="banner_static_wonder">
                        <p>
                            <i class="material-icons">
                                done_all
                            </i> FEEL LIGHTER
                        </p>
                        <p>
                            <i class="material-icons">
                                done_all
                            </i> FEEL STRONGER
                        </p>
                        <p>
                            <i class="material-icons">
                                done_all
                            </i> BE HEALTHIER
                        </p>
                    </div>
                    <div class="banner_static_download">
                        <p>
                            Achieve optimal health and wellness with our functional health solutions. Our approach focuses
                            on addressing the root cause of health issues and creating personalized plans that work for you.
                            From nutrition and lifestyle changes to targeted supplementation and cutting-edge therapies, we
                            offer a comprehensive range of services to support your journey towards better health. With our
                            expert guidance and support, you can take control of your health and unlock your full potential.
                            Experience true vitality and well-being – start your journey to functional health today.
                        </p>
                        <a href="/posts" class="btn_download">
                            Get Started
                        </a>
                    </div>
                </div>
                <div class="banner_static_right">
                    <div class="banner_static_img">
                        <img src="{{ asset('gymer/media/images/home6/banner-guy.png') }}" alt="">
                    </div>
                    <div class="banner_static_img">
                        <img src="{{ asset('gymer/media/images/home6/banner-arrow.png') }}" alt="">
                    </div>
                    <div class="banner_static_img">
                        <img src="{{ asset('gymer/media/images/home6/banner-circle.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="megamenu-cookies">
        <div class="remove">
            <i class="material-icons">
                clear
            </i>
        </div>
        <p>This Website uses cookies to ensure you get the best experience in our website. We also use analytics software to
            track data of visitors. See more info <a href="#">here</a></p>
        <a class="agree" href="#">I agree</a>
    </section> --}}

    <!--==========================-->
    <!--=        Banner         =-->
    <!--==========================-->
    <section class="home_five_service">
        <div class="vigo_container_one">
            <div class="home_five_single_service">
                <div class="home_five_single_service_inner clearfix">
                    <div class="home_five_single_service_img">
                        <img src="{{ asset('gymer/media/images/home6/women.png') }}" alt="">
                    </div>
                    <div class="home_five_single_service_left">

                    </div>
                </div>
            </div>
            <div class="home_five_single_service">
                <div class="home_five_single_service_inner clearfix">
                    <div class="home_five_single_service_img">
                        <img src="{{ asset('gymer/media/images/home6/men.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="home_five_single_service">
                <div class="home_five_single_service_inner clearfix">
                    <div class="home_five_single_service_img">
                        <img src="{{ asset('gymer/media/images/home6/basket.png') }}" alt="">
                    </div>
                    <div class="home_five_single_service_left">
                        <h3>Living Healthy</h3>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal quickview-wrapper">
        <div class="quickview">
            <div class="container">
                <div class="row">
                    <span class="close-qv">
                        <i class="material-icons">close</i>
                    </span>
                    <div class="ingredient_slider_flex">
                        <div class="ingredient_slider_main">
                            <div class="ingredient_slider_one">
                                <div>
                                    <img src="media/images/ingredient2/ing-one-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-two-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-three-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-one-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-two-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-three-small.png" alt="">
                                </div>
                            </div>
                            <div class="ingredient_slider_two">
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-one.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-two.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-three.png" alt="">
                                    </div>
                                </div>

                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-four.png" alt="">
                                    </div>
                                </div>

                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-five.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-one.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ingredient_slider_detail">
                            <h4 class="product_title">Vaxin Regular (500mg), Mild Intake lorem ipsum dolor</h4>
                            <p class="product_ratting woocommerce-product-rating">

                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>

                                <span>(30 Reviews)</span>
                            </p>

                            <div class="product_price">
                                <p class="in-stock">IN STOCK</p>
                                <p class="out-stock">OUT OF STOCK</p>
                                <div class="price">
                                    <ins>
                                        <span class="woocommerce-Price-amount">
                                            $12.00
                                        </span>
                                    </ins>

                                    <del>
                                        <span class="woocommerce-Price-amount">
                                            $20.00
                                        </span>
                                    </del>
                                </div>
                            </div>

                            <form action="#" class="product-cart" method="post">
                                <div class="product-quantity quantity">
                                    <input name="quantity" value="1" data-product-qty=""
                                        class="cart__quantity-selector quantity-selector" type="text">
                                    <input value="-" class="qtyminus looking" type="button">
                                    <input value="+" class="qtyplus looking" type="button">
                                </div>
                                <div class="ingredient_slider_btn">
                                    <a href="#" class="single_add_to_cart_button">
                                        <i class="fas fa-shopping-cart"></i>
                                        ADD TO CART
                                    </a>
                                    <a href="#">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                                <div class="share-wrap">
                                    <a href="#">BUY FROM AMAZON</a>
                                    <a href="#">BUY FROM FLIPCART</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==========================-->
    <!--=        Offer         =-->
    <!--==========================-->
    <section class="home5_offer">
        <div class="vigo_container_two">
            <div class="home5_offer_detail">
                <div class="home5_offer_detail_bg">
                    <img src="{{ asset('gymer/media/images/home6/offer-bg.png') }}" alt="">
                </div>
                <div class="home5_offer_inner">
                    <div class="home5_offer_left">
                        <img src="{{ asset('gymer/media/images/home6/offer-left.png') }}" alt="">
                    </div>
                    <div class="home5_offer_center">
                        <h2>EATING HEALTHY&#60; </h2>
                        <p>"Eating healthy is not a punishment, it's a privilege that allows us to nourish our bodies, fuel
                            our minds, and live our best lives."</p>

                        <p>Healthy eating involves consuming a well-balanced and nutritious diet that includes whole,
                            minimally processed foods that are rich in essential nutrients. This includes a variety of
                            fruits, vegetables, lean proteins, whole grains, and healthy fats, while limiting highly
                            processed and unhealthy foods. A healthy diet can reduce the risk of chronic health conditions
                            and promote optimal health and well-being.</p>



                        <a href="/posts">
                            <p class="sign-up-single-button">
                                <input type="submit" value="  {{ __('Read Our Articles') }}">

                            </p>
                        </a>
                        {{-- </div>
                    <div class="home5_offer_right">
                        <span>$12</span>
                        <img src="media/images/home6/offer-right.png" alt="">
                    </div> --}}
                    </div>
                    {{-- <div class="home5_offer_social">
                    <span>Share Us-</span>
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
            </div>
    </section>

    <!--==========================-->

    <div class="modal quickview-wrapper">
        <div class="quickview">
            <div class="container">
                <div class="row">
                    <span class="close-qv">
                        <i class="material-icons">close</i>
                    </span>
                    <div class="ingredient_slider_flex">
                        <div class="ingredient_slider_main">
                            <div class="ingredient_slider_one">
                                <div>
                                    <img src="media/images/ingredient2/ing-one-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-two-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-three-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-one-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-two-small.png" alt="">
                                </div>
                                <div>
                                    <img src="media/images/ingredient2/ing-three-small.png" alt="">
                                </div>
                            </div>
                            <div class="ingredient_slider_two">
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-one.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-two.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-three.png" alt="">
                                    </div>
                                </div>

                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-four.png" alt="">
                                    </div>
                                </div>

                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-five.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="ingredient-img">
                                        <img src="media/images/ingredient2/ing-one.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ingredient_slider_detail">
                            <h4 class="product_title">Vaxin Regular (500mg), Mild Intake lorem ipsum dolor</h4>
                            <p class="product_ratting woocommerce-product-rating">

                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-star"></i>
                                </a>

                                <span>(30 Reviews)</span>
                            </p>

                            <div class="product_price">
                                <p class="in-stock">IN STOCK</p>
                                <p class="out-stock">OUT OF STOCK</p>
                                <div class="price">
                                    <ins>
                                        <span class="woocommerce-Price-amount">
                                            $12.00
                                        </span>
                                    </ins>

                                    <del>
                                        <span class="woocommerce-Price-amount">
                                            $20.00
                                        </span>
                                    </del>
                                </div>
                            </div>

                            <form action="#" class="product-cart" method="post">
                                <div class="product-quantity quantity">
                                    <input name="quantity" value="1" data-product-qty=""
                                        class="cart__quantity-selector quantity-selector" type="text">
                                    <input value="-" class="qtyminus looking" type="button">
                                    <input value="+" class="qtyplus looking" type="button">
                                </div>
                                <div class="ingredient_slider_btn">
                                    <a href="#" class="single_add_to_cart_button">
                                        <i class="fas fa-shopping-cart"></i>
                                        ADD TO CART
                                    </a>
                                    <a href="#">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                                <div class="share-wrap">
                                    <a href="#">BUY FROM AMAZON</a>
                                    <a href="#">BUY FROM FLIPCART</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==========================-->
    <!--=        Video         =-->
    <!--==========================-->
    <section class="home5_video">
        <div class="vigo_container_two">
            <div class="home5_video_total">
                <div class="section_title_four">
                    <h2>IMPORTANCE OF HORMORNAL BALANCE</h2>
                </div>
                <div class="home5_video_left">
                    <p style="color:white;">Hormone balance is essential for overall health and well-being, as hormones serve as messengers in
                        the body, regulating essential processes such as growth, metabolism, reproduction, and mood.
                    </p>

                   <div class="call_to_action_right_two">
                                <a href="/posts" class="btn_four">Find Out More</a>
                     </div>
                    {{-- <div class="home5_video_social">
                        <span>SHARE US -</span>
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
                {{-- <div class="youtube-wrapper home5_video_right">
                    <div class="youtube-poster" data-bg-image="media/images/home6/video-5.png"></div>
                    <iframe src="https://www.youtube.com/embed/pCo40Y6UpWg" allowfullscreen></iframe>
                    <i class="material-icons play">
                        play_arrow
                    </i>
                    <i class="material-icons pause">
                        pause
                    </i>
                </div> --}}
            </div>
        </div>
    </section>
    <!--==========================-->
    <!--=        Video         =-->
    <!--==========================-->
    <section class="home5-most-sold" data-bg-image="media/images/home6/most-sold.jpg">
        <div class="vigo_container_one">
            <div class="section_title_four">
                <h2>SOME OF OUR PRODUCTS</h2>
            </div>
            <div class="row">
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-one.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/relate-pd-two.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-three.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-four.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-five.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-one.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/relate-pd-two.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-three.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-four.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-five.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/related-pd-one.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-lg-3">
                    <div class="sn_related_product">
                        <div class="sn_pd_img">
                            <a href="#">
                                <img src="media/images/banner-two/relate-pd-two.png" alt="">
                            </a>
                        </div>
                        <div class="sn_pd_rating">
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                            <a href="#">
                                <i class="far fa-star"></i>
                            </a>
                        </div>
                        <div class="sn_pd_detail">
                            <h5>
                                <a href="#">Vaxin Regular (500mg), Mild Intake</a>
                            </h5>
                            <ins>
                                <span>$16.00</span>
                            </ins>
                            <del>
                                <span>$20.00</span>
                            </del>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==========================-->
    <!--=        Video         =-->
    <!--==========================-->
    <section class="call_to_action_green">
        <div class="vigo_container_two">
            <div class="call_to_action_area_two">
                <div class="row">
                    <div class="col-xl-10 offset-xl-2">
                        <div class="call_to_action_hello">
                            <div class="call_to_action_left_two">
                                <h2>LIVE HEALTHY?</h2>
                                <p>Read our articles , get more knowledge on how to live a healthy lifestyle</p>
                                <p>" Book an appointment through our live chat " </p>
                            </div>
                            <div class="call_to_action_right_two">
                                <a href="/posts" class="btn_four">Read Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
