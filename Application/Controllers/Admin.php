<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.2
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Admin extends Controller
{
    private $authorId;
    public function __construct()
    {

        if ((!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 1)) {
            header('Location: ' . base_url('auth/login'));
            exit();
        } else if (isset($_SESSION['loggedIn']) && $_SESSION['role'] != 1) {
            set_flush_data('login_responce', 'You are not permitted as Admin!', 'error');
            header('Location: ' . base_url('auth/login'));
            exit();
        } else if (isset($_SESSION['userID'])) {
            $this->authorId = $_SESSION['userID'];
        } else {
            $this->authorId = 1;
        }
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard'
        );

        $this->view('admin/header');
        $this->view('admin/index', $data);
        $this->view('admin/footer');
    }

    public function events($action = '', $id = '')
    {
        if ($action == '') {
            $event_model = $this->load_model('Event_Model');
            if (isset($_POST['delete'])) {
                $event_id = $this->secure_input($_POST['event-id']);
                $delete = $event_model->delete($event_id);
                if ($delete) {
                    set_flush_data('event_moderation_responce', 'Post Deleted!', 'success');
                } else {
                    set_flush_data('event_moderation_responce', 'Something Wrong!', 'error');
                }
            }

            $data = array(
                'events' => $event_model->getAllEvents()
            );

            // var_dump($data);
            // exit();

            $this->view('admin/header');
            $this->view('admin/events', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'add') {

            $event_model = $this->load_model('event_model');
            $data = array(
                'categories' => $event_model->getAllCategories()
            );

            if (isset($_POST['publish-post']) || isset($_POST['draft-post'])) {
                if (isset($_POST['draft-post'])) {
                    $post_status = 3;
                } else {
                    $post_status = $_POST['status'];
                }
                $featuredImageUrl = NULL;
                $has_featured_photo = 0;
                if (isset($_FILES["featured-image"])) {
                    if (file_exists($_FILES["featured-image"]["tmp_name"])) {
                        $target_dir = ROOT . "uploads/post-images/";
                        $target_file = $target_dir . basename($_FILES["featured-image"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $has_featured_photo = 1;
                    }

                    if ($has_featured_photo && $_FILES["featured-image"]["size"] > 5000000) {
                        set_flush_data('add_post_responce', 'Sorry, your file is too large.', 'error');
                    } else if ($has_featured_photo && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
                        set_flush_data('add_post_responce', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
                    } else if ($has_featured_photo && move_uploaded_file($_FILES["featured-image"]["tmp_name"], $target_file)) {
                        $featuredImageUrl = basename($_FILES["featured-image"]["name"]);
                    }
                }


                $post_data = array(
                    'title' => $this->secure_input($_POST['title']),
                    'body' => $this->secure_input($_POST['body']),
                    'category' => $this->secure_input($_POST['category']),
                    'status' => $this->secure_input($post_status),
                    'authorId' => $this->authorId,
                    'featuredImage' => $featuredImageUrl,
                    'createdAt' => date('Y-m-d H:i:s')
                );

                $add_post = $post_model->insertPost($post_data);
                if ($add_post && $post_status == 3) {
                    set_flush_data('add_post_responce', 'Your Post has been saved as Draft!');
                } else if ($add_post && $post_status == 2) {
                    set_flush_data('add_post_responce', 'Your Post has been saved as Unblished!');
                } else if ($add_post) {
                    set_flush_data('add_post_responce', 'Your Post has been Published!');
                } else {
                    set_flush_data('add_post_responce', 'Something Wrong!');
                }
            }

            $this->view('admin/header');
            $this->view('admin/events-add', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'edit') {
            if (!isset($id) || empty($id)) {
                header('Location: ' . base_url('admin/events'));
                exit();
            }
            $post_model = $this->load_model('Post_Model');

            if (isset($_POST['update-post'])) {

                $featuredImageUrl = NULL;
                $has_featured_photo = 0;
                $post_status = $this->secure_input($_POST['status']);
                if (isset($_FILES["featured-image"])) {
                    if (file_exists($_FILES["featured-image"]["tmp_name"])) {
                        $target_dir = ROOT . "uploads/post-images/";
                        $target_file = $target_dir . basename($_FILES["featured-image"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $has_featured_photo = 1;
                    }

                    if ($has_featured_photo && $_FILES["featured-image"]["size"] > 5000000) {
                        set_flush_data('add_post_responce', 'Sorry, your file is too large.', 'error');
                    } else if ($has_featured_photo && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
                        set_flush_data('add_post_responce', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
                    } else if ($has_featured_photo && move_uploaded_file($_FILES["featured-image"]["tmp_name"], $target_file)) {
                        $featuredImageUrl = basename($_FILES["featured-image"]["name"]);
                    }
                }

                $post_data = array(
                    'title' => $this->secure_input($_POST['title']),
                    'body' => $this->secure_input($_POST['body']),
                    'category' => $this->secure_input($_POST['category']),
                    'status' => $this->secure_input($_POST['status']),
                    'featuredImage' => $featuredImageUrl,
                    'updatedAt' => date('Y-m-d H:i:s')
                );

                $update_post = $post_model->updatePost($id, $post_data);
                if ($update_post && $post_status == 3) {
                    set_flush_data('update_post_responce', 'Your Post has been saved as Draft!', 'success');
                } else if ($update_post && $post_status == 2) {
                    set_flush_data('update_post_responce', 'Your Post has been saved as Unblished!', 'success');
                } else if ($update_post) {
                    set_flush_data('update_post_responce', 'Your Post has been Published!', 'success');
                } else {
                    set_flush_data('update_post_responce', 'Something Wrong!', 'error');
                }
            }

            $data = array(
                'post_data' => $post_model->getPostByID($id),
                'categories' => $post_model->getAllCategories()
            );

            $this->view('admin/header');
            $this->view('admin/events-edit', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . base_url('admin'));
            exit();
        }
    }


    public function semester_activities($action = '', $id = '')
    {
        if ($action == '') {
            $semester_activity_model = $this->load_model('SemesterActivity_Model');
            if (isset($_POST['delete'])) {
                $activity_id = $this->secure_input($_POST['activity-id']);
                $delete = $semester_activity_model->delete($activity_id);
                if ($delete) {
                    set_flush_data('activity_moderation_responce', 'Activity Deleted!', 'success');
                } else {
                    set_flush_data('activity_moderation_responce', 'Something Wrong!', 'error');
                }
            }

            $data = array(
                'semester_activities' => $semester_activity_model->getAllActivitiesWithAllMeta()
            );

            $this->view('admin/header');
            $this->view('admin/semester_activities', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'add') {

            $semester_activity_model = $this->load_model('SemesterActivity_Model');
            $category_model = $this->load_model('Category_Model');
            $semester_model = $this->load_model('Semester_Model');
            $data = array(
                'categories' => $category_model->getAllCategories(),
                'semesters' => $semester_model->getAllSemesters()
            );

            if (isset($_POST['publish-activity']) || isset($_POST['draft-activity'])) {
                if (isset($_POST['draft-activity'])) {
                    $post_status = 3;
                } else {
                    $post_status = $_POST['status'];
                }

                $activity_data = array(
                    'title' => $this->secure_input($_POST['title']),
                    'description' => $this->secure_input($_POST['description']),
                    'date' => $this->secure_input($_POST['date']),
                    'time' => $this->secure_input($_POST['time']),
                    'venue' => $this->secure_input($_POST['venue']),
                    'category' => $this->secure_input($_POST['category']),
                    'semester' => $this->secure_input($_POST['semester']),
                    'status' => $this->secure_input($post_status),
                    'createdAt' => date('Y-m-d H:i:s')
                );

                // var_dump($post_data);
                // exit();

                $add_activity = $semester_activity_model->insert($activity_data);
                if ($add_activity && $post_status == 3) {
                    set_flush_data('add_post_responce', 'Your Activity has been saved as Draft!');
                } else if ($add_activity && $post_status == 2) {
                    set_flush_data('add_post_responce', 'Your Activity has been saved as Unpublished!');
                } else if ($add_activity) {
                    set_flush_data('add_post_responce', 'Your Activity has been Published!');
                } else {
                    set_flush_data('add_post_responce', 'Something Wrong!');
                }
            }

            $this->view('admin/header');
            $this->view('admin/semester_activities-add', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'edit') {
            if (!isset($id) || empty($id)) {
                header('Location: ' . base_url('admin/semester_activities'));
                exit();
            }
            $semester_activity_model = $this->load_model('SemesterActivity_Model');
            $category_model = $this->load_model('Category_Model');
            $semester_model = $this->load_model('Semester_Model');

            if (isset($_POST['update-post'])) {

                $featuredImageUrl = NULL;
                $has_featured_photo = 0;
                $post_status = $this->secure_input($_POST['status']);
                if (isset($_FILES["featured-image"])) {
                    if (file_exists($_FILES["featured-image"]["tmp_name"])) {
                        $target_dir = ROOT . "uploads/post-images/";
                        $target_file = $target_dir . basename($_FILES["featured-image"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $has_featured_photo = 1;
                    }

                    if ($has_featured_photo && $_FILES["featured-image"]["size"] > 5000000) {
                        set_flush_data('add_post_responce', 'Sorry, your file is too large.', 'error');
                    } else if ($has_featured_photo && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
                        set_flush_data('add_post_responce', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
                    } else if ($has_featured_photo && move_uploaded_file($_FILES["featured-image"]["tmp_name"], $target_file)) {
                        $featuredImageUrl = basename($_FILES["featured-image"]["name"]);
                    }
                }

                $post_data = array(
                    'title' => $this->secure_input($_POST['title']),
                    'body' => $this->secure_input($_POST['body']),
                    'category' => $this->secure_input($_POST['category']),
                    'status' => $this->secure_input($_POST['status']),
                    'featuredImage' => $featuredImageUrl,
                    'updatedAt' => date('Y-m-d H:i:s')
                );

                $update_post = $post_model->updatePost($id, $post_data);
                if ($update_post && $post_status == 3) {
                    set_flush_data('update_post_responce', 'Your Post has been saved as Draft!', 'success');
                } else if ($update_post && $post_status == 2) {
                    set_flush_data('update_post_responce', 'Your Post has been saved as Unblished!', 'success');
                } else if ($update_post) {
                    set_flush_data('update_post_responce', 'Your Post has been Published!', 'success');
                } else {
                    set_flush_data('update_post_responce', 'Something Wrong!', 'error');
                }
            }

            $data = array(
                'activity_data' => $semester_activity_model->getActivityByID($id),
                'categories' => $category_model->getAllCategories(),
                'semesters' => $semester_model->getAllSemesters()
            );

            $this->view('admin/header');
            $this->view('admin/semester_activities-edit', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . base_url('admin'));
            exit();
        }
    }

    public function categories($action = '', $id = '')
    {
        $category_model = $this->load_model('Category_Model');

        if ($action == '') {

            if (isset($_POST['active'])) {
                $category_id = $this->secure_input($_POST['category-id']);
                $active = $category_model->activeCategory($category_id);
                if ($active) {
                    set_flush_data('category_moderation_responce', 'Category Active!');
                } else {
                    set_flush_data('category_moderation_responce', 'Something Wrong!');
                }
            } else if (isset($_POST['disable'])) {
                $category_id = $this->secure_input($_POST['category-id']);
                $disable = $category_model->disableCategory($category_id);
                if ($disable) {
                    set_flush_data('category_moderation_responce', 'Category Disabled!');
                } else {
                    set_flush_data('category_moderation_responce', 'Something Wrong!');
                }
            } else if (isset($_POST['delete'])) {
                $category_id = $this->secure_input($_POST['category-id']);
                $delete = $category_model->deleteCategory($category_id);
                if ($delete) {
                    set_flush_data('category_moderation_responce', 'Category Deleted!');
                } else {
                    set_flush_data('category_moderation_responce', 'Something Wrong!');
                }
            }

            $data = array(
                'categories' => $category_model->getAllCategories(),
            );
            $this->view('admin/header');
            $this->view('admin/category', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'add') {
            $data = array();
            if (isset($_POST['add-category'])) {
                $category_data = array(
                    'name' => $this->secure_input($_POST['name']),
                    'url' => $this->secure_input($_POST['url']),
                    'status' => $this->secure_input($_POST['status'])
                );

                $add_category = $category_model->insertCategory($category_data);
                if ($add_category) {
                    set_flush_data('category_moderation_responce', 'Category Added!', 'success');
                } else {
                    set_flush_data('category_moderation_responce', 'Something Wrong!', 'error');
                }
            }

            $this->view('admin/header');
            $this->view('admin/category-add', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'edit') {
            if (!$id) {
                header('Location: ' . base_url('admin/categories'));
                exit();
            }

            if (isset($_POST['save-category'])) {
                $category_data = array(
                    'name' => $this->secure_input($_POST['name']),
                    'url' => $this->secure_input($_POST['url']),
                    'status' => $this->secure_input($_POST['status'])
                );
                $save_category = $category_model->updateCategory($id, $category_data);
                if ($save_category) {
                    set_flush_data('category_moderation_responce', 'Category Edited!');
                } else {
                    set_flush_data('category_moderation_responce', 'Something Wrong!');
                }
            }

            $data = array(
                'category_data' => $category_model->getCategoryData($id)
            );
            $this->view('admin/header');
            $this->view('admin/category-edit', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . base_url('admin'));
            exit();
        }
    }

    public function users($action = '', $id = '')
    {
        $user_model = $this->load_model('User_Model');

        if ($action == '') {
            $data = array(
                'users' => $user_model->getAllUsers(),
            );

            $this->view('admin/header');
            $this->view('admin/users', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'add') {
            $data = array();

            $this->view('admin/header');
            $this->view('admin/users-add', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'edit') {
            if (!$id == '') {
                if (isset($_POST['update-user'])) {
                    $user_old_data = $user_model->getByUserId($id);
                    $temp_username = $this->secure_input($_POST['username']);
                    $temp_email = $this->secure_input($_POST['email']);
                    $temp_pass;
                    if (empty($_POST['username'])) {
                        set_flush_data('user_moderation_responce', 'username required!', 'error');
                    } else if (empty($_POST['firstName'])) {
                        set_flush_data('user_moderation_responce', 'firstName required!', 'error');
                    } else if (empty($_POST['email'])) {
                        set_flush_data('user_moderation_responce', 'email required!', 'error');
                    } else if (($user_old_data->username != $temp_username) && $user_model->getUser($temp_username)) {
                        set_flush_data('user_moderation_responce', 'username already exixt!', 'error');
                    } else if (($user_old_data->email != $temp_email) && $user_model->getUser($temp_email)) {
                        set_flush_data('user_moderation_responce', 'email already exixt!', 'error');
                    } else if ($_POST['password'] != $_POST['re_password']) {
                        set_flush_data('user_moderation_responce', 'Password mismatch!', 'error');
                    } else {
                        if (isset($_POST['password']) && $_POST['password'] != '') {
                            $cng_pass = true;
                            $temp_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        } else {
                            $cng_pass = false;
                            $temp_pass = $user_old_data->password;
                        }
                        $user_data = array(
                            'username' => $this->secure_input($_POST['username']),
                            'firstName' => $this->secure_input($_POST['firstName']),
                            'lastName' => $this->secure_input($_POST['lastName']),
                            'email' => $this->secure_input($_POST['email']),
                            'role' => $this->secure_input($_POST['role']),
                            'status' => $this->secure_input($_POST['status']),
                            'password' => $temp_pass,
                            'updatedAt' => date('Y-m-d H:i:s')
                        );

                        $update_user = $user_model->updateUser($id, $user_data);
                        if ($update_user && $cng_pass) {
                            set_flush_data('user_moderation_responce', 'User data and Password edited successfully!', 'success');
                        } else if ($update_user) {
                            set_flush_data('user_moderation_responce', 'User data edited successfully!', 'success');
                        } else {
                            set_flush_data('user_moderation_responce', 'Something Wrong!', 'error');
                        }

                        //var_dump($user_data); exit();
                    }
                }

                $data = array(
                    'user_data' => $user_model->getByUserId($id),
                    'user_roles' => $user_model->getUserRoles()
                );

                $this->view('admin/header');
                $this->view('admin/users-edit', $data);
                $this->view('admin/footer');
            } else {
                header('Location: ' . base_url('admin/users'));
                exit();
            }
        } else {
            header('Location: ' . base_url('admin'));
            exit();
        }
    }
}