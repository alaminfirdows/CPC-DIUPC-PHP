<div class="app-title">
  <div>
    <h1><i class="fa fa-th-list"></i> All Comments</h1>
    <p>Table to display all Post</p>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Comments</li>
    <li class="breadcrumb-item active"><a href="#">All Comments</a></li>
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
              <th>Post Id</th>
              <th>Comment</th>
              <th>Status</th>
              <th>Comment At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($comments as $comment): ?>
            <?php
              if ($comment->status == 1) {
                $comment_status = 'Approved';
              } else if ($comment->status == 2) {
                $comment_status = 'Denied';
              } else if ($comment->status == 3) {
                $comment_status = 'Spam';
              } else {
                $comment_status = 'Unknown';
              }
            ?>
            <tr>
              <td><?=$comment->postId;?></td>
              <td><?=$comment->body;?></td>
              <td><?=$comment_status;?></td>
              <td><?=$comment->createdAt;?></td>
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="comment-id" id="comment-id" value="<?=$comment->id;?>">
                  <button type="submit" class="btn btn-link" id="approve" name="approve" <?php if($comment->status != 1) { } else { echo 'disabled'; } ?>>Approve</button>
                  <button type="submit" class="btn btn-link" id="deny" name="deny" <?php if($comment->status != 2) { } else { echo 'disabled'; } ?>>Deny</button>
                  <button type="submit" class="btn btn-link" id="mark-spam" name="mark-spam" <?php if($comment->status != 3) { } else { echo 'disabled'; } ?>>Mark as Spam</button>
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