<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Users</h1>
        <p>Table to display all Users</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active"><a href="#">All Users</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $responce = get_flush_data('user_moderation_responce');
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user->id; ?></td>
                            <td><?= $user->firstName . ' ' . $user->lastName; ?></td>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->user_role; ?></td>
                            <td><?= $user->email; ?></td>
                            <td>
                                <a href="<?= base_url('admin/users/edit/') . $user->id; ?>" class="mr-3">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>