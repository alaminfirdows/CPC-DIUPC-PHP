<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2 class="title">Recent posts</h2>
						</div>
					</div>
					<?php foreach ($category_posts as $category_post): ?>
					<!-- post -->
					<div class="col-md-6">
						<div class="post">
							<a class="post-img" href="<?= base_url('posts/details/').$category_post->id;?>">
								<img src="<?php if(isset($category_post->featuredImage) && $category_post->featuredImage !='') { echo post_image_url($category_post->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>" alt="<?=$category_post->title; ?>" style="height: 220px">
							</a>
								
							<div class="post-body">
								<div class="post-category">
									<a href="#"><?=$category_post->cat_name; ?></a>
								</div>
								<h3 class="post-title"><a href="<?= base_url('posts/details/').$category_post->id; ?>"><?=$category_post->title; ?></a></h3>
								<ul class="post-meta">
									<li><a href="#"><?=$category_post->author; ?></a></li>
									<li><?=$category_post->createdAt; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php endforeach; ?>
				</div>
				<!-- /row -->
			</div>
			<div class="col-md-4">
				<!-- ad widget-->
				<div class="aside-widget text-center">
					<a href="#" style="display: inline-block;margin: auto;">
						<img class="img-responsive" src="<?= base_url('assets'); ?>/img/ad-3.jpg" alt="">
					</a>
				</div>
				<!-- /ad widget -->

				<!-- social widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title">Social Media</h2>
					</div>
					<div class="social-widget">
						<ul>
							<li>
								<a href="#" class="social-facebook">
									<i class="fa fa-facebook"></i>
									<span>21.2K<br>Followers</span>
								</a>
							</li>
							<li>
								<a href="#" class="social-twitter">
									<i class="fa fa-twitter"></i>
									<span>10.2K<br>Followers</span>
								</a>
							</li>
							<li>
								<a href="#" class="social-google-plus">
									<i class="fa fa-google-plus"></i>
									<span>5K<br>Followers</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /social widget -->

				<!-- category widget -->
				<div class="aside-widget" style="display: none;">
					<div class="section-title">
						<h2 class="title">Categories</h2>
					</div>
					<div class="category-widget">
						<ul>
							<li><a href="#">Lifestyle <span>451</span></a></li>
							<li><a href="#">Fashion <span>230</span></a></li>
							<li><a href="#">Technology <span>40</span></a></li>
							<li><a href="#">Travel <span>38</span></a></li>
							<li><a href="#">Health <span>24</span></a></li>
						</ul>
					</div>
				</div>
				<!-- /category widget -->

				<!-- newsletter widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title">Newsletter</h2>
					</div>
					<div class="newsletter-widget">
						<form>
							<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
							<input class="input" name="newsletter" placeholder="Enter Your Email">
							<button class="primary-button">Subscribe</button>
						</form>
					</div>
				</div>
				<!-- /newsletter widget -->

				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title">Popular Posts</h2>
					</div>

					<?php foreach ($popular_posts as $popular_post): ?>
					<!-- post -->
					<div class="post post-widget">
						<a class="post-img" href="<?= base_url('posts/details/').$popular_post->id;?>">
							<img src="<?php if(isset($popular_post->featuredImage) && $popular_post->featuredImage !='') { echo post_image_url($popular_post->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>" alt="<?=$popular_post->title; ?>" style="height: 90px">
						</a>
						<div class="post-body">
							<div class="post-category">
								<a href="#"><?=$popular_post->cat_name; ?></a>
							</div>
							<h3 class="post-title"><a href="<?= base_url('posts/details/').$popular_post->id; ?>"><?=$popular_post->title; ?></a></h3>
						</div>
					</div>
					<!-- /post -->
					<?php endforeach; ?>
				</div>
				<!-- /post widget -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->