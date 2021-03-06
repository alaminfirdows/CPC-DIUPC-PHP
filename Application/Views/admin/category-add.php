<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Add New Category</h1>
        <p>Add New Category</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Category</a></li>
        <li class="breadcrumb-item active"><a href="#">Add New Category</a></li>
    </ul>
</div>
<?php
$responce = get_flush_data('category_moderation_responce');
if (isset($responce) && !empty($responce)) :
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert <?php if ($responce['type'] == 'error') {
                                    echo 'alert-danger';
                                } else if ($responce['type'] == 'success') {
                                    echo 'alert-success';
                                } else {
                                    echo 'alert-info';
                                } ?> alert-dismissible show" role="alert">
            <?= $responce['data']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<form action="" method="POST">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="tile">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input class="form-control" id="name" name="name" type="text">
                    <small class="form-text text-muted">It will shows as Category Name.</small>
                </div>
                <div class="form-group">
                    <label for="title">Url</label>
                    <input class="form-control" id="url" name="url" type="text">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="tile">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="mt-3">
                    <a href="<?= base_url('admin/categories/'); ?>" class="btn btn-secondary btn-block">Cancel</a>
                    <button class="btn btn-block btn-primary" type="submit" id="add-category" name="add-category">Add
                        Category</button>
                </div>
            </div>
        </div>
    </div>
</form>