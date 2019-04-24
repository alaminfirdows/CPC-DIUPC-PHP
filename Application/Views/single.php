<!-- PAGE HEADER -->
<div id="post-header" class="page-header">
	<div class="page-header-bg" style="background: url('<?php if(isset($post_data->featuredImage) && $post_data->featuredImage !='') { echo post_image_url($post_data->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>') no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;" data-stellar-background-ratio="0.5"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="post-category">
					<a href="#"><?= $post_cat; ?></a>
				</div>
				<h1><?= $post_data->title; ?></h1>
				<ul class="post-meta">
					<li><a href="#"><?= $post_author; ?></a></li>
					<li><?= $post_data->createdAt; ?></li>
					<li><i class="fa fa-comments"></i> <?= count($comnents); ?></li>
					<li><i class="fa fa-eye"></i> <?= $post_data->views; ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->	<!-- section -->
<div class="section">
<!-- container -->
<div class="container">
	<!-- row -->
	<div class="row">
		<div class="col-md-8">
			<!-- post share -->
			<div class="section-row">
				<div class="post-share">
					<a href="http://www.facebook.com/sharer.php?u=<?=base_url('posts').'/details/'.$post_data->id; ?>" class="social-facebook"><i class="fa fa-facebook"></i><span>Share</span></a>
					<a href="https://twitter.com/share?url=<?=base_url('posts').'/details/'.$post_data->id; ?>" class="social-twitter"><i class="fa fa-twitter"></i><span>Tweet</span></a>
					<a href="mailto:?Subject=<?= $post_data->title; ?>&amp;Body=<?= $post_data->body; ?> <?=base_url('posts').'/details/'.$post_data->id; ?>" ><i class="fa fa-envelope"></i><span>Email</span></a>
				</div>
			</div>
			<!-- /post share -->

			<!-- post content -->
			<div class="section-row">
				<?= htmlspecialchars_decode($post_data->body); ?>
			</div>
			<!-- /post content -->

			<!-- /related post -->
			<div>
				<div class="section-title">
					<h3 class="title">Related Posts</h3>
				</div>
				<div class="row">
				<?php foreach ($related_posts as $related_post): ?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post post-sm">
							<a class="post-img" href="<?= base_url('posts').'/details/'.$related_post->id; ?>">
								<img src="<?php if(isset($related_post->featuredImage) && $related_post->featuredImage !='') { echo post_image_url($related_post->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>" alt="<?=$related_post->title; ?>" style="height: 150px;">
							</a>
							<div class="post-body">
								<div class="post-category">
									<a href="#"><?=$related_post->cat_name; ?></a>
								</div>
								<h3 class="post-title title-sm"><a href="<?= base_url('posts').'/details/'.$related_post->id; ?>"><?=$related_post->title; ?></a></h3>
								<ul class="post-meta">
									<li><a href="#"><?=$related_post->author; ?></a></li>
									<li><?=$related_post->createdAt; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /post -->
				<?php endforeach; ?>
				</div>
			</div>
			<!-- /related post -->

			<!-- post comments -->
			<div class="section-row">
				<div class="section-title">
					<h3 class="title"><?= count($comnents); ?> Comments</h3>
				</div>
				<div class="post-comments">
				<?php foreach ($comnents as $comnent): ?>
					<!-- comment -->
					<div class="media">
						<div class="media-left">
							<img class="media-object" src="<?= base_url('assets').'/img/avatar.png'; ?>" alt="<?php if($comnent->author != ' ') { echo $comnent->author; } else { echo $comnent->subscriber; } ?>">
						</div>
						<div class="media-body">
							<div class="media-heading">
								<h4>
									<?php
									if($comnent->author != ' ') {
										echo $comnent->author;
									} else {
										echo $comnent->subscriber;
									}
									?>
								</h4>
								<span class="time"><?=$comnent->createdAt; ?></span>
							</div>
							<p><?= htmlspecialchars_decode($comnent->body); ?></p>
							<a href="#form-comment-<?= $post_data->id; ?>" class="reply">Reply</a>
						</div>
					</div>
					<!-- /comment -->
				<?php endforeach; ?>
				</div>
			</div>
			<!-- /post comments -->

			<!-- post reply -->
			<div class="section-row">
				<div class="section-title">
					<h3 class="title">Leave a reply</h3>
				</div>
				 <?php
			    $responce = get_flush_data('comment_responce');
			    if (isset($responce) && !empty($responce)):
			  ?>
			    <div class="row">
			      <div class="col-md-12">
			        <div class="alert <?php if($responce['type'] == 'error') { echo 'alert-danger'; } else if($responce['type'] == 'success') { echo 'alert-success'; } else { echo 'alert-info'; } ?> alert-dismissible show" role="alert">
			          <?= $responce['data']; ?>
			          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			          </button>
			        </div>
			      </div>
			    </div>
			  <?php endif; ?>
				<form id="form-comment-<?= $post_data->id; ?>" class="post-reply" action="" method="POST">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="input" name="body" id="body" placeholder="Message"></textarea>
							</div>
						</div>
						<?php if (!isset($_SESSION['userID'])): ?>
						<div class="col-md-6">
							<div class="form-group">
								<input class="input" type="text" name="name" id="name" placeholder="Name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input class="input" type="email" name="email" id="email" placeholder="Email">
							</div>
						</div>
						<input type="hidden" name="ip" id="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>">
						<?php else: ?>
						<input type="hidden" name="authorId" id="authorId" value="<?=$_SESSION['userID'];?>">
						<?php endif; ?>
						<div class="col-md-12">
							<button class="primary-button" type="submit" id="submit-comment" name="submit-comment">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<!-- /post reply -->
		</div>
		<div class="col-md-4">
			<!-- ad widget -->
			<div class="aside-widget text-center">
				<a href="#" style="display: inline-block;margin: auto;">
					<img class="img-responsive" src="<?=base_url('assets/img');?>/ad-3.jpg" alt="">
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
			<div class="aside-widget">
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
						<input class="input" placeholder="Enter Your Email">
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
						<img src="<?php if(isset($popular_post->featuredImage) && $popular_post->featuredImage !='') { echo post_image_url($popular_post->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>" alt="<?=$popular_post->title; ?>" style="height: 90px;">
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