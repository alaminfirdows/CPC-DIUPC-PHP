<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Edit Semester Activity</h1>
        <p>Edit Semester Activity</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Semester Activity</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit Semester Activity</a></li>
    </ul>
</div>
<form method="POST" action="" enctype="multipart/form-data">
    <?php
    $responce = get_flush_data('update_activity_responce');
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
                    <label for="title">Activity Title</label>
                    <input class="form-control" id="title" name="title" type="text" value="<?= $activity_data->title; ?>" required aria-describedby="titleHelp" placeholder="Enter Activity Title">
                    <small class="form-text text-muted" id="titleHelp">It will shows as Activity title.</small>
                </div>
                <div class="form-group">
                    <label for="body">Activity Description</label>
                    <textarea class="ckeditor form-control" id="description" name="description" rows="3" required><?= $activity_data->description; ?></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="body">Date</label>
                        <input class="form-control datepicker" id="date" name="date" type="text" value="<?= $activity_data->date; ?>" required aria-describedby="dateHelp" placeholder="Enter Activity Date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="body">Time</label>
                        <input class="form-control" id="time" name="time" type="time" value="<?= $activity_data->time; ?>" required aria-describedby="timeHelp" placeholder="Enter Activity Time">
                    </div>
                </div>
                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input class="form-control" id="venue" name="venue" type="text" value="<?= $activity_data->venue; ?>" required aria-describedby="venueHelp" placeholder="Enter Venue">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="tile">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" <?php if ($activity_data->status == 1) {
                                                echo 'selected';
                                            } ?>>Published</option>
                        <option value="2" <?php if ($activity_data->status == 2) {
                                                echo 'selected';
                                            } ?>>Unpublished</option>
                        <option value="3" <?php if ($activity_data->status == 3) {
                                                echo 'selected';
                                            } ?>>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>" <?php if ($category->id == $activity_data->category) {
                                                                        echo 'selected';
                                                                    } ?>><?= $category->name; ?></option>
                        <?php endforeach; ?>
                        <?php if (count($categories) < 1) : ?>
                            <option value=""><?= 'No Categoy Found!'; ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <?php foreach ($semesters as $semester) : ?>
                            <option value="<?= $semester->id; ?>" <?php if ($semester->id == $activity_data->semester) {
                                                                        echo 'selected';
                                                                    } ?>><?= $semester->name; ?></option>
                        <?php endforeach; ?>
                        <?php if (count($semesters) < 1) : ?>
                            <option value=""><?= 'No semester Found!'; ?></option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-6">
                        <a href="<?= base_url('admin/semester_activities/'); ?>" class="btn btn-secondary btn-block">Cancel</a>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-primary" type="submit" id="publish-activity" name="update-activity">Publish</button>
                    </div>
                </div>
            </div>
        </div>
</form>