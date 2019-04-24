
<div class="app-title">
  <div>
    <h1><i class="fa fa-th-list"></i> All Category</h1>
    <p>Table to display all Post</p>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Category</li>
    <li class="breadcrumb-item active"><a href="#">All Category</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <?php
      $responce = get_flush_data('category_moderation_responce');
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
              <th>Name</th>
              <th>Url</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categorys as $category): ?>
            <?php
              if ($category->status == 1) {
                $category_status = 'Active';
              } else if ($category->status == 0) {
                $category_status = 'Disabled';
              } else {
                $category_status = 'Unknown';
              }
            ?>
            <tr>
              <td><?=$category->name;?></td>
              <td><?=$category->url;?></td>
              <td><?=$category_status;?></td>
              <td><?=$category->createdAt;?></td>
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="category-id" id="category-id" value="<?=$category->id;?>">
                  <button type="submit" class="btn btn-link" id="active" name="active" <?php if($category->status != 1) { } else { echo 'disabled'; } ?>>Active</button>
                  <button type="submit" class="btn btn-link" id="disable" name="disable" <?php if($category->status != 0) { } else { echo 'disabled'; } ?>>Disable</button>
                  <a href="<?=base_url('blog_admin');?>/categories/edit/<?=$category->id;?>" class="mr-3">Edit</a>
                  <button type="submit" class="btn btn-link" id="delete" name="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
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
