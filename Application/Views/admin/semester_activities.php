<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Semester Activities</h1>
        <p>Table to display all Semester Activities</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Semester Activities</li>
        <li class="breadcrumb-item active"><a href="#">All Semester Activities</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $responce = get_flush_data('activity_moderation_responce');
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

        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered jsDataTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Semester</th>
                            <th>Category</th>
                            <th>Date - Time</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($semester_activities as $semester_activity) : ?>
                        <?php
                            if ($semester_activity->status == 1) {
                                $semester_activity_status = 'Published';
                            } else if ($semester_activity->status == 2) {
                                $semester_activity_status = 'Unpublished';
                            } else if ($semester_activity->status == 3) {
                                $semester_activity_status = 'Draft';
                            } else {
                                $semester_activity_status = 'Unknown';
                            }
                            ?>
                        <tr>
                            <td><?= $semester_activity->title; ?></td>
                            <td><?= $semester_activity->semester_name; ?></td>
                            <td><?= $semester_activity->cat_name; ?></td>
                            <td><?= $semester_activity->date; ?> - <?= $semester_activity->time; ?> </td>
                            <td><?= $semester_activity_status; ?></td>
                            <td><?= $semester_activity->createdAt; ?></td>
                            <td>
                                <a href="<?= base_url('semester_activities/details/') . $semester_activity->id; ?>"
                                    class="mr-3" target="_blank">View</a>
                                <a href="<?= base_url('admin/semester_activities/edit/') . $semester_activity->id; ?>"
                                    class="mr-3">Edit</a>
                                <form action="" method="POST" style="display: inline-block">
                                    <input type="hidden" name="activity-id" id="activity-id"
                                        value="<?= $semester_activity->id; ?>">
                                    <button type="submit" class="btn btn-link mr-3" id="delete" name="delete"
                                        onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
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