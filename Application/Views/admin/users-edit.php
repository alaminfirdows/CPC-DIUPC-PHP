<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Edit User</h1>
        <p>Edit a user</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active"><a href="#">Edit User</a></li>
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
                <form action="" method="POST" id="login_form" class="login-form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Username</label>
                                <input class="form-control" id="username" name="username" type="text"
                                    aria-describedby="titleHelp" placeholder="Enter username"
                                    value="<?= $user_data->username; ?>" required>
                                <small class="form-text text-muted" id="titleHelp">It will use as login id.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="title">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter Email" value="<?= $user_data->email; ?>" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">First Name</label>
                                <input class="form-control" id="firstName" name="firstName" type="text"
                                    placeholder="Enter FirstName" value="<?= $user_data->firstName; ?>" required></div>
                            <div class="col-md-6">
                                <label for="title">Last Name</label>
                                <input class="form-control" id="lastName" name="lastName" type="text"
                                    placeholder="Enter LastName" value="<?= $user_data->lastName; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <?php foreach ($user_roles as $user_role) : ?>
                                    <option value="<?= $user_role->id; ?>" <?php if ($user_role->id == $user_data->role) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $user_role->name; ?></option>
                                    <?php endforeach; ?>
                                    <?php if (count($user_roles) < 1) : ?>
                                    <option value=""><?= 'No Role Found!'; ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" <?php if ($user_data->status == 1) {
                                                            echo 'selected';
                                                        } ?>>Active</option>
                                    <option value="0" <?php if ($user_data->status == 0) {
                                                            echo 'selected';
                                                        } ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Enter Password" aria-describedby="passHelp">
                                <small class="form-text text-muted" id="passHelp">If you want to change password, Please
                                    put new password here. Otherwse Leave it empty.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="title">Repeat Password</label>
                                <input class="form-control" id="re_password" name="re_password" type="password"
                                    placeholder="Re Enter Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group btn-container">
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <a href="<?= base_url('admin/users'); ?>" class="btn btn-secondary btn-block">Cancel</a>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-block btn-primary" type="submit" id="update-user"
                                    name="update-user">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>