@extends('layouts.app')

@section('content')
    <!--=========================-->
    <!--=        Breadcrumb         =-->
    <!--=========================-->
    <section class="breadcrumb_area">
        <div class="vigo_container_two">
            <div class="page_header">
                <h1>Livewell Shopping</h1>
            </div>
            <!-- /.page-header -->
        </div>
        <!-- /.vigo_container_two -->
    </section>

    <section class="product_all_collection with-sidebar">
        <div class="vigo_container_two">
            <div class="product_all_collection_flex">
                <div class="product_all_collection_flex_item">
                    <div class="product_sidebar">
                        <section class="widget widget_search">
                            <div class="search-form-product">
                                <input type="search" id="search-form" class="search-field" placeholder="Search …"
                                    value="" name="s">
                                <button type="submit" class="search-submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </section>
                        <section class="widget widget_catergories">
                            <h3 class="widget_title">Product Categories</h3>
                            <ul class="widget_catgories">
                                @foreach ($category as $productCategory)
                                    <li><a href="/category/{{$productCategory->id}}">{{ $productCategory->name}}</a></li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </div>
                <div class="product_all_collection_flex_item_big">
                   <br>
                   <br>
                    <div class="woocommerce">
                        <div class="row products">
                            @foreach ($product as $product)
                                <div class="col-xl-3 col-sm-6 product">
                                    <div class="sn_related_product">
                                        <a href="shop/product/{{$product->id}}" class="woocommerce-LoopProduct-link">
                                            <div class="sn_pd_img product-thumb">
                                                <img src="/upload/{{$product->image}}" alt="!!">
                                            </div>
                                           <br>
                                           <br>
                                            <div class="sn_pd_detail">
                                                <h5 class="woocommerce-loop-product__title">{{$product->name}}</h5>
                                                <div class="price">
                                                    <ins>
                                                        <span>${{$product->price}}</span>
                                                    </ins>
                                                    <del>
                                                        <span>{{$product->price + $product->discount}}</span>
                                                    </del>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
