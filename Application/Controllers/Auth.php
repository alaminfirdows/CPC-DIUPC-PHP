<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Auth extends Controller
{
    public function __construct()
    { }

    public function index()
    {
        header('Location: ' . base_url('auth/login'));
        exit();
    }

    public function login()
    {
        $user_model = $this->load_model('User_Model');
        $data = array(
            'title' => 'Login'
        );

        if (isset($_POST['login'])) {
            $login_user = $this->secure_input($_POST['user']);
            $login_pass = $this->secure_input($_POST['pass']);
            $user = $user_model->getUser($login_user);
            if ($user) {
                if (password_verify($login_pass, $user->password)) {
                    if ($user->status == 0) {
                        set_flush_data('login_responce', 'Your ID is inactive!', 'error');
                    } else {
                        $user_data = array(
                            'userID' => $user->id,
                            'username' => $user->username,
                            'firstName' => $user->firstName,
                            'lastName' => $user->lastName,
                            'email' => $user->email,
                            'role' => $user->role,
                            'profilePicture' => $user->profilePicture,
                            'loggedIn' => TRUE
                        );

                        foreach ($user_data as $key => $value) {
                            $_SESSION[$key] = $value;
                        }
                        set_flush_data('login_responce', 'Login Successfull!', 'success');
                        if ($user->role == 1) {
                            header('Location: ' . base_url('admin'));
                        } else {
                            header('Location: ' . base_url());
                        }
                        exit();
                    }
                } else {
                    set_flush_data('login_responce', 'Password Invalid!', 'error');
                }
            } else {
                set_flush_data('login_responce', 'Username or Email Invalid!', 'error');
            }
        }

        $this->view('auth/login', $data);
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $user_data = array('userID', 'username', 'firstName', 'lastName', 'email', 'role', 'profilePicture', 'loggedIn');

        foreach ($user_data as $key) {
            unset($_SESSION[$key]);
        }
        $_SESSION = array();
        session_destroy();

        header('Location: ' . base_url('auth/login'));
        exit();
    }
    public function register()
    {
        $user_model = $this->load_model('User_Model');

        $data = array(
            'title' => 'Login'
        );
        if (isset($_POST['register'])) {
            $login_username = $this->secure_input($_POST['username']);
            $login_email = $this->secure_input($_POST['email']);
            if ($user_model->getUser($login_username)) {
                set_flush_data('register_responce', 'username already exixt!', 'error');
            } else if ($user_model->getUser($login_email)) {
                set_flush_data('register_responce', 'email already exixt!', 'error');
            } else if ($_POST['password'] != $_POST['re_password']) {
                set_flush_data('register_responce', 'Password mismatch!', 'error');
            } else {
                $user_data = array(
                    'username' => $this->secure_input($_POST['username']),
                    'firstName' => $this->secure_input($_POST['firstName']),
                    'lastName' => $this->secure_input($_POST['lastName']),
                    'email' => $this->secure_input($_POST['email']),
                    'role' => 2,
                    'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
                );

                $register = $user_model->insertUser($user_data);
                if ($register) {
                    set_flush_data('register_responce', 'Registered Successfully!', 'success');
                } else if ($add_post && $post_status == 2) {
                    set_flush_data('register_responce', 'Something Wrong!', 'error');
                }
            }
        }
        $this->view('auth/register', $data);
    }
}