<div>
<section class="blog_list_area single-post">
	<div class="vigo_container_two">
		<div class="blog_list_flex">
			<div class="blog_list_flex_item_big">
				<div class="blog-details">
					<article class="post">
						<div class="post-thumb">
							<img src="/upload/{{$post->image_path}}" alt="">
						</div>
						<header class="entry-header">
							<h2 class="blog-title">{{$post->title}}</h2>
							<ul class="meta">
								<li>
									<span class="posted-on">
										<a href="#" class="entry-date">
											<span>24 <sup>th</sup> December, 2018</span>
										</a>
									</span>
									<span class="category">
										<a class="" href="#">Category: {{$post->category->name}}</a>
									</span>
								</li>
								<li>
									<a href="#"><i class="fa fa-comments-o"></i>
										comments (13)
									</a>
								</li>
							</ul>
							<!-- .entry-meta -->
						</header>
						<div class="entry-content">
						<p>{!!$postContent!!}</p>
							@guest
							<li><a href="#"  wire:click="continueReading" class="prev"><i class="fas fa-angle-double-right"></i> CONTINUE READING</a></li>
							@else
							@if(!$canRead)
							<li><a href="#" wire:click="continueReading" class="prev"><i class="fas fa-angle-double-right"></i> SUBSCRIBE TO CONTINUE READING</a></li>
							@endif
							@endguest



						</div>
					</article>
{{--					<nav class="blog_list_pagination">--}}
{{--						<ul class="blog_list_nav_links">--}}
{{--							<li><a href="#" class="prev"><i class="fas fa-angle-double-left"></i> PREV</a></li>--}}
{{--							<li><a href="#" class="next">NEXT<i class="fas fa-angle-double-right"></i></a></li>--}}
{{--						</ul>--}}
{{--					</nav>--}}


					<div id="comments" class="comments-area">
                        <br>
						<h2 class="comments-title">
							RESPONSES ({{count($comments)}})
						</h2>
						<ol class="comment-list">
							<li id="comment-2" class="comment even thread-even depth-1">
                                @foreach($comments as $comment)
								<article id="div-comment-2" class="comment-body">
									<footer class="comment-meta">
										<div class="comment-author vcard">

											<b class="fn">
												<a href="#" rel="external nofollow" class="url">{{\App\Models\User::find($comment->user_id)->name}}</a>
											</b>
										</div>

										<div class="comment-metadata">
											<a href="#">
												<p>
													- {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
												</p>
											</a>
										</div>
									</footer>

									<div class="comment-content">
										<span>
											{{$comment->content}}
										</span>

										<div class="reply">
											<a rel="nofollow" class="comment-reply-link" href="#"></a>
										</div>
									</div>
								</article>
                                @endforeach
								<!-- .comment-body -->
							</li>
						</ol>
						<!-- .comment -->
                        {{ $comments->links() }}

						<div id="respond" class="comment-respond">
							<h2 id="reply-title" class="comment-reply-title">
								LEAVE YOUR COMMENTS
							</h2>
							<form wire:submit.prevent="addComment" action="#" method="post" id="commentform" class="comment-form" novalidate="">
								<p class="comment-form-comment">
									<label>Comment Here <span class="required">*</span></label>
									<textarea id="comment" required="required" wire:model="newComment"></textarea>
								</p>

								<p class="form-submit">
									<input type="submit"  id="submit" class="submit" value="COMMENT" wire:click="addComment">
								</p>

							</form>
						</div>
						<!-- .reply -->
					</div>
				</div>
			</div>
            <div class="blog_list_flex_item">
                <aside class="blog_list_sidebar sidebar">
                    <section class="widget widget_search">
                        <form role="search" method="GET" class="search-form" action="{{ route('blogSearch') }}">
                            <label>
                                <i class="fas fa-search"></i>
                                <input name="search" class="search-field" placeholder="Search here…" type="search">
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
                                    <a href="/blogCategory/{{$category->id}}">
                                        <i class="fas fa-burn"></i>
                                        <p>
                                            {{$category->name}}
                                        </p>
                                    </a>
                                </li>
                            @endforeach


                        </ul>
                    </section>
                </aside>
            </div>
		</div>
	</div>
	<div class="blog_list_social_fixed">
		<div class="blog_list_social_fixed-mobile">
			<i class="fas fa-angle-right"></i>
			<ul>
				<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter"></i></a></li>
				<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
				<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
				<li><a href="#"><i class="fab fa-tumblr"></i></a></li>
				<li><a href="#"><i class="fab fa-medium-m"></i></a></li>
			</ul>
		</div>
	</div>
</section>
</div>
