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
							<li><a href="#" class="prev"><i class="fas fa-angle-double-right"></i> CONTINUE READING</a></li>
							@else
							@if(!$canRead)
							<li><a href="#" class="prev"><i class="fas fa-angle-double-right"></i> SUBSCRIBE TO CONTINUE READING</a></li>
							@endif
							@endguest
							
						

						</div>
					</article>
					<nav class="blog_list_pagination">
						<ul class="blog_list_nav_links">
							<li><a href="#" class="prev"><i class="fas fa-angle-double-left"></i> PREV</a></li>
							<li><a href="#" class="next">NEXT<i class="fas fa-angle-double-right"></i></a></li>
						</ul>
					</nav>


					<div id="comments" class="comments-area">
						<h2 class="comments-title">
							RESPONSES (2)
						</h2>
						<ol class="comment-list">
							<li id="comment-2" class="comment even thread-even depth-1">
								<article id="div-comment-2" class="comment-body">
									<footer class="comment-meta">
										<div class="comment-author vcard">
											<img src="media/images/home6/com-one.jpg" alt="!!">
											<b class="fn">
												<a href="#" rel="external nofollow" class="url">Maria Sarapova</a>
											</b>
										</div>

										<div class="comment-metadata">
											<a href="#">
												<p>
													- Jan 22, 2018
												</p>
											</a>
										</div>
									</footer>

									<div class="comment-content">
										<span>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
											ut labore et dolore magna aliqua. Ut enim
										</span>

										<div class="reply">
											<a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
										</div>
									</div>
								</article>
								<!-- .comment-body -->
								<ul class="children">
									<li>
										<article class="comment-body">
											<footer class="comment-meta">
												<div class="comment-author vcard">
													<img src="media/images/home6/com-two.jpg" alt="!!">
													<b class="fn">
														<a href="#" rel="external nofollow" class="url">Christen Stuart</a>
													</b>
												</div>

												<div class="comment-metadata">
													<a href="#">
														<p>
															- Jan 22, 2018
														</p>
													</a>
												</div>
											</footer>

											<div class="comment-content">
												<span>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
													incididunt ut labore et dolore magna
												</span>

												<div class="reply">
													<a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
												</div>
											</div>
										</article>
										<!-- .comment-body -->
										<ul class="children">
											<li>
												<article class="comment-body">
													<footer class="comment-meta">
														<div class="comment-author vcard">
															<img src="media/images/home6/com-three.jpg" alt="!!">
															<b class="fn">
																<a href="#" rel="external nofollow" class="url">Hope Casseddy</a>
															</b>
														</div>

														<div class="comment-metadata">
															<a href="#">
																<p>
																	- Jan 22, 2018
																</p>
															</a>
														</div>
													</footer>

													<div class="comment-content">
														<span>
															It's difficult to find examples of lorem ipsum in use before Letraset made
															it popular as a dummy text in the
														</span>

														<div class="reply">
															<a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
														</div>
													</div>
												</article>
												<!-- .comment-body -->
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ol>
						<!-- .comment -->


						<div id="respond" class="comment-respond">
							<h2 id="reply-title" class="comment-reply-title">
								LEAVE YOUR COMMENTS
							</h2>
							<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
								<p class="comment-form-comment">
									<label>Comment Here <span class="required">*</span></label>
									<textarea id="comment" required="required"></textarea>
								</p>
								<p class="comment-form-author">
									<label>Your Name <span class="required">*</span></label>
									<input id="author" type="text" required="required">
								</p>
								<p class="comment-form-email">
									<label>Your Email <span class="required">*</span></label>
									<input id="email" type="email" required="required">
								</p>
								<p class="form-submit">
									<input type="submit" id="submit" class="submit" value="COMMENT">
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
							<li class="cat-item">
								<i class="fas fa-burn"></i>
								<p>
									FAT<br> BURNERS
								</p>
							</li>
							<li class="cat-item">
								<i class="far fa-star"></i>
								<p>
									BUDGET<br> SUPPLIMENT
								</p>
							</li>
							<li class="cat-item">
								<i class="fas fa-heartbeat"></i>
								<p>
									HEART<br> DISEASES
								</p>
							</li>
							<li class="cat-item">
								<i class="fas fa-magic"></i>
								<p>
									MAGICAL<br> DIET
								</p>
							</li>
							<li class="cat-item">
								<i class="fas fa-glass-martini"></i>
								<p>
									DRINK<br> CHART
								</p>
							</li>
							<li class="cat-item">
								<i class="fas fa-leaf"></i>
								<p>
									HARB<br> INTAKES
								</p>
							</li>
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
