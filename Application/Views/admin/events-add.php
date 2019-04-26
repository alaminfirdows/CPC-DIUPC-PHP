<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Add New Events</h1>
        <p>Add New Events</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Events</a></li>
        <li class="breadcrumb-item active"><a href="#">Add New Events</a></li>
    </ul>
</div>
<form method="POST" action="#" enctype="multipart/form-data">
    <?php
    $responce = get_flush_data('add_event_responce');
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
                    <input class="form-control" id="title" name="title" type="text" required aria-describedby="titleHelp" placeholder="Enter Event Title">
                    <small class="form-text text-muted" id="titleHelp">It will shows as event title.</small>
                </div>
                <div class="form-group">
                    <label for="description">Event Description</label>
                    <textarea class="ckeditor form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control datepicker" id="date" name="date" type="text" required aria-describedby="dateHelp" placeholder="Enter Activity Date">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="tile">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" selected="">Published</option>
                        <option value="2">Unpublished</option>
                        <option value="3">Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
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
                            <option value="<?= $semester->id; ?>"><?= $semester->name; ?></option>
                        <?php endforeach; ?>
                        <?php if (count($semesters) < 1) : ?>
                            <option value=""><?= 'No semester Found!'; ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 d-none" id="showFeaturedImageDiv" style="border: 2px solid #ced4da;">
                    <img src="<?= base_url('assets'); ?>/images/no-featured-image.png" id="showFeaturedImage" alt="showFeaturedImage" class="img-fluid">
                </div>
                <button class="btn btn-primary btn-block mb-3 d-none" id="removeFeaturedImage" type="button" onclick="$('#showFeaturedImage').attr('src', ''); $('#featured-image').val(''); $('#showFeaturedImageDiv').removeClass('d-block').addClass('d-none'); $('#removeFeaturedImage').removeClass('d-block').addClass('d-none');">Remove</button>

                <label for="featured-image">Featured Image</label>
                <div class="form-group custom-file">
                    <input type="file" class="custom-file-input" name="featured-image" id="featured-image" onchange="document.getElementById('showFeaturedImage').src = window.URL.createObjectURL(this.files[0]); $('#showFeaturedImageDiv').addClass('d-block'); $('#removeFeaturedImage').addClass('d-block');">
                    <label class="custom-file-label" for="featured-image">Choose file...</label>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-secondary" type="submit" id="draft-event" name="draft-event">Save
                            Draft</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-primary" type="submit" id="publish-event" name="publish-event">Publish</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>