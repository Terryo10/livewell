@extends('layouts.app')

@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->
<section class="breadcrumb_area">
    <div class="vigo_container_two">
        <div class="page_header">
            <h1>Category: {{$category->name}}</h1>
        </div>
        <!-- /.page-header -->
    </div>
    <!-- /.vigo_container_two -->
</section>
<!-- /.breadcrumb_area -->

<!--==========================-->
<!--=        Video         =-->
<!--==========================-->
<section class="blog_list_area">
    <div class="vigo_container_two">
        <div class="blog_list_flex">
            <div class="blog_list_flex_item_big">
                <div class="blog_all_list">
                    @foreach ($posts as $post)
                      <div class="blog_single_list">
                        <div class="blog_single_list_img">
                            <div class="post-thumbnail">
                                <img src="/upload/{{$post->image_path}}" alt="!!">
                            </div>
                            <a href="/post/{{$post->id}}" class="blog_single_list_btn">
                                <span>read</span>
                                <i class="material-icons">
                                    arrow_forward
                                </i>
                            </a>
                        </div>
                        <div class="blog_single_list_content">
                            <h3 class="blog_title">
                                <a href="/post/{{$post->id}}">{{$post->title}}</a>
                            </h3>
                            <div class="blog_meta">
                                <a href="/post/{{$post->id}}">
                                    <span>24<sup>th</sup> December</span>
                                </a>
                            </div>
                        </div>
                    </div>   
                    @endforeach
                   
                   
                </div>
                <nav class="blog_list_pagination">
                    <ul class="blog_list_nav_links">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">
                                <span>.</span>
                                <span>.</span>
                                <span>.</span>
                                <span>.</span>
                            </a></li>
                        <li><a href="#">9</a></li>
                    </ul>
                    <ul class="blog_list_nav_links two">
                        <li><a href="#" class="prev"><i class="fas fa-angle-double-left"></i> prev</a></li>
                        <li><a href="#" class="next">next <i class="fas fa-angle-double-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <div class="blog_list_flex_item">
                <aside class="blog_list_sidebar sidebar">
                    <section class="widget widget_search">
                        <form role="search" method="get" class="search-form" action="http://wptest.io/demo/">
                            <label>
                                <i class="fas fa-search"></i>
                                <input class="search-field" placeholder="Search here…" type="search">
                            </label>
                            <button type="submit" class="search-submit">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </section>
                    <section class="widget widget_categories">
                        <h2 class="widget-title">Category</h2>
                        <ul>
                            @foreach ($categories as $category)
                               <li class="cat-item">
                                <i class="fas fa-burn"></i>
                                <p>
                                  {{$category->name}}
                                </p>
                            </li> 
                            @endforeach
                            
                            
                        </ul>
                    </section>
                </aside>
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
                            <p>Try out our suppliment & enjoy the healthiest life. Discounts end soon!</p>
                        </div>
                        <div class="call_to_action_right_two">
                            <a href="#" class="btn_four">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection