<div class="app-title">
  <div>
    <h1><i class="fa fa-th-list"></i> Posts</h1>
    <p>Table to display all Post</p>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item active"><a href="#">All Posts</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <?php
      $responce = get_flush_data('post_moderation_responce');
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
    
    <div class="tile">
      <div class="tile-body">
        <table class="table table-hover table-bordered jsDataTable">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Category</th>
              <th>Views</th>
              <th>Status</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($posts as $post): ?>
            <?php
              if ($post->status == 1) {
                $post_status = 'Published';
              } else if ($post->status == 2) {
                $post_status = 'Unpublished';
              } else if ($post->status == 3) {
                $post_status = 'Draft';
              } else {
                $post_status = 'Unknown';
              }
            ?>
            <tr>
              <td><?= $post->title; ?></td>
              <td><?= $post->author; ?></td>
              <td><?= $post->cat_name; ?></td>
              <td><?= $post->views; ?></td>
              <td><?= $post_status; ?></td>
              <td><?= $post->createdAt; ?></td>
              <td>
                <a href="<?=base_url('posts/details/').$post->id;?>" class="mr-3" target="_blank" >View</a>
                <a href="<?=base_url('blog_admin/posts/edit/').$post->id;?>" class="mr-3">Edit</a>
                <form action="" method="POST">
                  <input type="hidden" name="post-id" id="post-id" value="<?=$post->id;?>">
                  <button type="submit" class="btn btn-link mr-3" id="delete" name="delete"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
              </td>
            </tr>

          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
