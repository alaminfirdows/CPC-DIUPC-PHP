<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Events</h1>
        <p>Table to display all Events</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active"><a href="#">All Events</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $responce = get_flush_data('event_moderation_responce');
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
                            <th>Views</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event) : ?>
                        <?php
                            if ($event->status == 1) {
                                $event_status = 'Published';
                            } else if ($event->status == 2) {
                                $event_status = 'Unpublished';
                            } else if ($event->status == 3) {
                                $event_status = 'Draft';
                            } else {
                                $event_status = 'Unknown';
                            }
                            ?>
                        <tr>
                            <td><?= $event->title; ?></td>
                            <td><?= $event->semester_name; ?></td>
                            <td><?= $event->cat_name; ?></td>
                            <td><?= $event->views; ?></td>
                            <td><?= $event_status; ?></td>
                            <td><?= $event->createdAt; ?></td>
                            <td>
                                <a href="<?= base_url('events/details/') . $event->id; ?>" class="mr-3"
                                    target="_blank">View</a>
                                <a href="<?= base_url('admin/events/edit/') . $event->id; ?>" class="mr-3">Edit</a>
                                <form action="" method="POST" style="display: inline-block">
                                    <input type="hidden" name="event-id" id="event-id" value="<?= $event->id; ?>">
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