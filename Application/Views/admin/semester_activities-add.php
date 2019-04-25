<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Add New Semester Activity</h1>
        <p>Add New Semester Activity</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Semester Activities</a></li>
        <li class="breadcrumb-item active"><a href="#">Add New Activity</a></li>
    </ul>
</div>
<form method="POST" action="#" enctype="multipart/form-data">
    <?php
    $responce = get_flush_data('add_post_responce');
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
                    <input class="form-control" id="title" name="title" type="text" required aria-describedby="titleHelp" placeholder="Enter Activity Title">
                    <small class="form-text text-muted" id="titleHelp">It will shows as Activity title.</small>
                </div>
                <div class="form-group">
                    <label for="body">Activity Description</label>
                    <textarea class="ckeditor form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="body">Date</label>
                        <input class="form-control datepicker" id="date" name="date" type="text" required aria-describedby="dateHelp" placeholder="Enter Activity Date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="body">Time</label>
                        <input class="form-control" id="time" name="time" type="time" required aria-describedby="timeHelp" placeholder="Enter Activity Time">
                    </div>
                </div>
                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input class="form-control" id="venue" name="venue" type="text" required aria-describedby="venueHelp" placeholder="Enter Venue">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="tile">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" selected="">Published</option>
                        <option value="2">Unblessed</option>
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

                <div class="row mt-3">
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-secondary" type="submit" id="draft-activity" name="draft-activity">Save
                            Draft</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-primary" type="submit" id="publish-activity" name="publish-activity">Publish</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>