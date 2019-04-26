<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Edit Events</h1>
        <p>Edit Events</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Events</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit Events</a></li>
    </ul>
</div>

<form method="POST" action="#" enctype="multipart/form-data">
    <?php
    $responce = get_flush_data('update_event_responce');
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
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="tile">
                <div class="form-group">
                    <label for="title">Event Title</label>
                    <input class="form-control" id="title" name="title" type="text" value="<?= $event_data->title; ?>"
                        required aria-describedby="titleHelp" placeholder="Enter Event Title">
                    <small class="form-text text-muted" id="titleHelp">It will shows as event title.</small>
                </div>
                <div class="form-group">
                    <label for="description">Event Description</label>
                    <textarea class="ckeditor form-control" id="description" name="description" rows="5"
                        required><?= $event_data->description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control datepicker" id="date" name="date" type="text"
                        value="<?= $event_data->date; ?>" required aria-describedby="dateHelp"
                        placeholder="Enter Activity Date">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="tile">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" <?php if ($event_data->status == 1) {
                                                echo 'selected';
                                            } ?>>Published</option>
                        <option value="2" <?php if ($event_data->status == 2) {
                                                echo 'selected';
                                            } ?>>Unpublished</option>
                        <option value="3" <?php if ($event_data->status == 3) {
                                                echo 'selected';
                                            } ?>>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id; ?>" <?php if ($category->id == $event_data->category) {
                                                                        echo 'selected';
                                                                    } ?>><?= $category->name; ?></option>
                        <?php endforeach; ?>
                        <?php if (count($categories) < 1) : ?>
                        <option value=""><?= 'No Category Found!'; ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <?php foreach ($semesters as $semester) : ?>
                        <option value="<?= $semester->id; ?>" <?php if ($semester->id == $event_data->semester) {
                                                                        echo 'selected';
                                                                    } ?>><?= $semester->name; ?></option>
                        <?php endforeach; ?>
                        <?php if (count($semesters) < 1) : ?>
                        <option value=""><?= 'No semester Found!'; ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3" id="showFeaturedImageDiv" style="border: 2px solid #ced4da;">
                    <img src="<?= event_image_url($event_data->featuredImage); ?>" id="showFeaturedImage"
                        alt="showFeaturedImage" class="img-fluid">
                </div>
                <button class="btn btn-primary btn-block mb-3 d-none" id="removeFeaturedImage" type="button"
                    onclick="$('#showFeaturedImage').attr('src', ''); $('#featured-image').val(''); $('#showFeaturedImageDiv').removeClass('d-block').addClass('d-none'); $('#removeFeaturedImage').removeClass('d-block').addClass('d-none');">Remove</button>

                <label for="featured-image">Featured Image</label>
                <div class="form-group custom-file">
                    <input type="file" class="custom-file-input" name="featured-image" id="featured-image"
                        onchange="document.getElementById('showFeaturedImage').src = window.URL.createObjectURL(this.files[0]); $('#showFeaturedImageDiv').addClass('d-block'); $('#removeFeaturedImage').addClass('d-block');">
                    <label class="custom-file-label" for="featured-image">Choose file...</label>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <a href="<?= base_url('admin/events/'); ?>" class="btn btn-secondary btn-block">Cancel</a>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-primary" type="submit" id="publish-event"
                            name="update-event">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>