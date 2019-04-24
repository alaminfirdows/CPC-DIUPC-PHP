<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i>Edit Posts</h1>
    <p>Edit Posts</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="#">Posts</a></li>
    <li class="breadcrumb-item active"><a href="#">Edit Posts</a></li>
  </ul>
</div>
<form method="POST" action="" enctype="multipart/form-data">
  <?php
    $responce = get_flush_data('update_post_responce');
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
  <div class="row">
    <div class="col-md-12 col-lg-8">
      <div class="tile">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input class="form-control" id="title" name="title" type="text" required aria-describedby="titleHelp" placeholder="Enter Post Title" value="<?=$post_data->title;?>">
          <small class="form-text text-muted" id="titleHelp">It will shows as post title.</small>
        </div>
        <div class="form-group">
          <label for="body">Post Description</label>
          <textarea class="ckeditor form-control" id="body" name="body" rows="3" required><?=$post_data->title;?></textarea>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-4">
      <div class="tile">
	      <div class="form-group">
	        <label for="status">Status</label>
	        <select class="form-control" id="status" name="status" required>
	          <option value="1" <?php if ($post_data->status == 1) { echo 'selected';} ?>>Published</option>
	          <option value="2" <?php if ($post_data->status == 2) { echo 'selected';} ?>>Unblished</option>
	          <option value="3" <?php if ($post_data->status == 3) { echo 'selected';} ?>>Draft</option>
	        </select>
	      </div>
	      <div class="form-group">
	        <label for="category">Category</label>
	        <select class="form-control" id="category" name="category" required>
          <?php foreach($categorys as $category): ?>
            <option value="<?= $category->id; ?>" <?php if($category->id == $post_data->category) { echo 'selected';} ?>><?= $category->name; ?></option>
          <?php endforeach; ?>
          <?php if (count($categorys) < 1): ?>
            <option value=""><?= 'No Categoy Found!'; ?></option>
          <?php endif; ?>
	        </select>
        </div>
        <div class="mb-3" id="showFeaturedImageDiv" style="border: 2px solid #ced4da;">
          <img src="<?php if(isset($post_data->featuredImage) && $post_data->featuredImage !='') { echo post_image_url($post_data->featuredImage); } else { echo base_url('assets').'/img/post-no-image.png'; }?>" alt="<?=$post_data->title; ?>" id="showFeaturedImage" alt="showFeaturedImage" class="img-fluid">
        </div>
        <button class="btn btn-primary btn-block mb-3 d-none" id="removeFeaturedImage" type="button" onclick="$('#showFeaturedImage').attr('src', ''); $('#featured-image').val(''); $('#showFeaturedImageDiv').removeClass('d-block').addClass('d-none'); $('#removeFeaturedImage').removeClass('d-block').addClass('d-none');">Remove</button>

        <label for="featured-image">Featured Image</label>
        <div class="form-group custom-file">
          <input type="file" class="custom-file-input" name="featured-image" id="featured-image" onchange="document.getElementById('showFeaturedImage').src = window.URL.createObjectURL(this.files[0]); $('#showFeaturedImageDiv').addClass('d-block'); $('#removeFeaturedImage').addClass('d-block');" value="<?php if(isset($post_data->featuredImage) && $post_data->featuredImage !='') { echo $post_data->featuredImage; } else { echo ''; }?>">
          <label class="custom-file-label" for="featured-image">Choose file...</label>
        </div>
        <div class="row mt-3">
        	<div class="col-sm-6">
        		<a href="<?=base_url('blog_admin/posts/');?>" class="btn btn-secondary btn-block">Cancel</a>
        	</div>
	        <div class="col-sm-6">
	        	<button class="btn btn-block btn-primary" type="submit" id="update-post" name="update-post">Update</button>
	        </div>
    		</div>
    	</div>
    </div>
  </div>
</form>