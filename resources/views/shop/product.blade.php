@extends('layouts.app')

@section('content')
    <section class="breadcrumb_area_list">
        <div class="vigo_container_two">
            <div class="page_header_list">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">SHOP</a></li>
                    <li>{{$product->name}}</li>
                </ul>
            </div>
            <!-- /.page-header -->
        </div>
        <!-- /.vigo_container_two -->
    </section>
    <!-- /.breadcrumb_area -->

    <!--=========================-->
    <!--=        Ingredient2         =-->
    <!--=========================-->
    <section class="ingredeint_section ingredeint2_section ingredeint4_section">
        <div class="vigo_container_two">
            <div class="ingredient_slider_flex">
                <div class="ingredient_slider_main">
                    <div class="ingredient_slider_one">
                        <div>
                            <img src="/upload/{{$product->image}}" alt="">
                        </div>
                        
                    </div>
                    <div class="ingredient_slider_two">
							<div>
								<div class="ingredient-img">
									<img src="/upload/{{$product->image}}" alt="">
								</div>
							</div>
						</div>
                    
                </div>
                <div class="ingredient_slider_detail">
                    <h4 class="product_title">{{$product->name}}</h4>
                    <p class="product_ratting woocommerce-product-rating">
                        
                        <span>(30 Reviews)</span>
                        <a href="#reviews" class="write_scroll_review" data-moveto=".review_nav">
                            <span class="write_review">
                                <i class="fas fa-pencil-alt"></i>
                                Write a review
                            </span>
                        </a>
                    </p>

                    <div class="product_desc woocommerce-product-details__short-description">
                        <p>
                            {{$product->description}}
                        </p>
                    </div>

                   

                    <div class="product_price">
                        <p class={{$product->stock > 0 ?'in-stock' : "out-stock"}}>{{$product->stock > 0 ? 'IN STOCK' : 'OUT OF STOCK'}}</p>
                        <div class="price">
                            <ins>
                                <span class="woocommerce-Price-amount">
                                    ${{$product->price}}
                                </span>
                            </ins>

                            <del>
                                <span class="woocommerce-Price-amount">
                                   ${{$product->price + $product->discount}}
                                </span>
                            </del>
                        </div>
                    </div>

                    <form action="#" class="product-cart" method="post">
                        <div class="product-quantity quantity">
                            <input id="Quantity" name="quantity" value="1" data-product-qty=""
                                class="cart__quantity-selector quantity-selector" type="text">
                            <input value="-" class="qtyminus looking" type="button">
                            <input value="+" class="qtyplus looking" type="button">
                        </div>
                        <div class="ingredient_slider_btn">
                            <a href="#" class="single_add_to_cart_button">
                                <i class="fas fa-shopping-cart"></i>
                                ADD THIS
                            </a>
                            <a class="this_heart" href="#">
                                <i class="far fa-heart"></i>
                            </a>
                            <p><i class="fas fa-check"> </i> ADDED TO CART SUCCESSFULLY !</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="vaxine_all_fact2">
        <div class="vigo_container_two">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product_review_tab">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#description" role="tab">DESCRIPTION</a>
                            </li>
                
                            <li>
                                <a class="review_nav" data-toggle="tab" href="#reviews" role="tab">REVIEWS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <p>
                                 {{$product->description}}
                                </p>
                            </div>
                            
                            
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="review_detail">
                                    <div class="review_comments">
                                        <div class="single_review">
                                            <div class="sn_review_left">
                                                <img src="media/images/banner-two/review_com_one.png" alt="">
                                            </div>
                                            <div class="sn_review_right">
                                                <a href="#">
                                                    Bonny Plunkette - <span>Jan 22, 2018</span>
                                                </a>
                                                <div class="sn_review_icon">
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
                                                <div class="sn_review_desc">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                        ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                        aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single_review">
                                            <div class="sn_review_left">
                                                <img src="media/images/banner-two/review_com_one.png" alt="">
                                            </div>
                                            <div class="sn_review_right">
                                                <a href="#">
                                                    Bonny Plunkette - <span>Jan 22, 2018</span>
                                                </a>
                                                <div class="sn_review_icon">
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
                                                <div class="sn_review_desc">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                        ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                        aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form">
                                        <h5>GIVE YOUR REVIEW <span>( Your email address will remain unpublished )</span>
                                        </h5>
                                        <div class="product_rating">
                                            <h5>Rate this product :</h5>
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
                                        <form action="#">
                                            <div class="sn_review_input">
                                                <label>Your review*</label>
                                                <textarea></textarea>
                                            </div>
                                            <div class="sn_review_input">
                                                <label>Name*</label>
                                                <input type="text">
                                            </div>
                                            <div class="sn_review_input">
                                                <label>Email*</label>
                                                <input type="text">
                                            </div>
                                            <button class="btn_two" type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_share">
                <ul>
                    <li class="facebook">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                            <span><i class="fab fa-facebook-f"></i> - SHARE ON FACEBOOK</span>
                        </a>
                    </li>
                    <li class="twitter">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                            <span><i class="fab fa-twitter"></i> - SHARE ON Twitter</span>
                        </a>
                    </li>
                    <li class="instagram">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                            <span><i class="fab fa-instagram"></i> - SHARE ON INSTAGRAM</span>
                        </a>
                    </li>
                    <li class="gplus">
                        <a href="#">
                            <i class="fab fa-google-plus-g"></i>
                            <span><i class="fab fa-google-plus-g"></i> - SHARE ON GOOGLE PLUS</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!--==========================-->
    <!--=        Related product         =-->
    <!--==========================-->
    <section class="related_product related_product_two">
        <div class="vigo_container_two">
            <div class="row">
                <div class="col-xl-12">
                    <div class="related_product_title">
                        <h1>RELATED PRODUCTS</h1>
                    </div>
                    <div class="related_product_slider owl-carousel">
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
                                <ins>
                                    <span>$16.00</span>
                                </ins>
                                <del>
                                    <span>$20.00</span>
                                </del>
                            </div>
                        </div>
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
                                <h5><a href="#">Vaxin Regular (500mg), Mild Intake</a></h5>
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
        </div>
    </section>
@endsection
