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
            $post_model = $this->load_model('Post_Model');
            if (isset($_POST['delete'])) {
                $post_id = $this->secure_input($_POST['post-id']);
                $delete = $post_model->deletePost($post_id);
                if ($delete) {
                    set_flush_data('post_moderation_responce', 'Post Deleted!', 'success');
                } else {
                    set_flush_data('post_moderation_responce', 'Something Wrong!', 'error');
                }
            }

            $data = array(
                'events' => $post_model->getAllPostsWithAllMeta()
            );

            $this->view('admin/header');
            $this->view('admin/events', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'add') {

            $post_model = $this->load_model('Post_Model');
            $data = array(
                'categorys' => $post_model->getAllCategorys()
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
                'categorys' => $post_model->getAllCategorys()
            );

            $this->view('admin/header');
            $this->view('admin/events-edit', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . base_url('blog_admin'));
            exit();
        }
    }

    public function comments($action = '', $id = '')
    {
        $comment_model = $this->load_model('Comment_Model');

        if (isset($_POST['approve'])) {
            $comment_id = $this->secure_input($_POST['comment-id']);
            $approve = $comment_model->approveComment($comment_id);
            if ($approve) {
                set_flush_data('comment_moderation_responce', 'Comment Approved!');
            } else {
                set_flush_data('comment_moderation_responce', 'Something Wrong!');
            }
        } else if (isset($_POST['deny'])) {
            $comment_id = $this->secure_input($_POST['comment-id']);
            $deny = $comment_model->denyComment($comment_id);
            if ($deny) {
                set_flush_data('comment_moderation_responce', 'Comment Denied!');
            } else {
                set_flush_data('comment_moderation_responce', 'Something Wrong!');
            }
        } else if (isset($_POST['mark-spam'])) {
            $comment_id = $this->secure_input($_POST['comment-id']);
            $mark_spam = $comment_model->markSpamComment($comment_id);
            if ($mark_spam) {
                set_flush_data('comment_moderation_responce', 'Comment Marked as Spam!');
            } else {
                set_flush_data('comment_moderation_responce', 'Something Wrong!');
            }
        } else if (isset($_POST['delete'])) {
            $comment_id = $this->secure_input($_POST['comment-id']);
            $delete = $comment_model->deleteComment($comment_id);
            if ($delete) {
                set_flush_data('comment_moderation_responce', 'Comment Deleted!');
            } else {
                set_flush_data('comment_moderation_responce', 'Something Wrong!');
            }
        }

        if ($action == '') {
            $data = array(
                'comments' => $comment_model->getAllComments(),
            );
            $this->view('admin/header');
            $this->view('admin/comments', $data);
            $this->view('admin/footer');
        } else if (!empty($action) && $action == 'pending') {
            $data = array(
                'pending_comments' => $comment_model->getAllPendingComments(),
            );

            $this->view('admin/header');
            $this->view('admin/comments-pending', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . base_url('blog_admin/comment'));
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
                'categorys' => $category_model->getAllCategorys(),
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
                header('Location: ' . base_url('blog_admin/categories'));
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
            header('Location: ' . base_url('blog_admin'));
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
                header('Location: ' . base_url('blog_admin/users'));
                exit();
            }
        } else {
            header('Location: ' . base_url('blog_admin'));
            exit();
        }
    }
}