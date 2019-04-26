<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> All Semester</h1>
        <p>Table to display all Post</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Semester</li>
        <li class="breadcrumb-item active"><a href="#">All Semester</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $responce = get_flush_data('semester_moderation_responce');
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
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($semesters as $semester) : ?>
                        <?php
                            if ($semester->status == 1) {
                                $semester_status = 'Active';
                            } else if ($semester->status == 0) {
                                $semester_status = 'Disabled';
                            } else {
                                $semester_status = 'Unknown';
                            }
                            ?>
                        <tr>
                            <td><?= $semester->name; ?></td>
                            <td><?= $semester_status; ?></td>
                            <td><?= $semester->createdAt; ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="semester-id" id="semester-id"
                                        value="<?= $semester->id; ?>">
                                    <button type="submit" class="btn btn-link" id="active" name="active"
                                        <?php if ($semester->status != 1) { } else {
                                                                                                                    echo 'disabled';
                                                                                                                } ?>>Active</button>
                                    <button type="submit" class="btn btn-link" id="disable" name="disable"
                                        <?php if ($semester->status != 0) { } else {
                                                                                                                    echo 'disabled';
                                                                                                                } ?>>Disable</button>
                                    <a href="<?= base_url('admin'); ?>/semesters/edit/<?= $semester->id; ?>"
                                        class="mr-3">Edit</a>
                                    <button type="submit" class="btn btn-link" id="delete" name="delete"
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