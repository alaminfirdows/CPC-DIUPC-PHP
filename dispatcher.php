<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        if (method_exists($controller, $this->request->action) && is_callable(array($controller, $this->request->action))) {
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        } else {
            if (file_exists(ROOT . 'Application/Views/errors/404.php')) {
                require(ROOT . 'Application/Views/errors/404.php');
            } else {
                echo "404 Not Found!";
            }
        }
    }

    public function loadController()
    {
        $ctrl_name = $this->request->controller;
        if (file_exists(ROOT . "Application/Controllers/" . ucfirst($ctrl_name) . '.php')) {
            require(ROOT . "Application/Controllers/" . ucfirst($ctrl_name) . '.php');
            $controller = new $ctrl_name();
            return $controller;
        } else {
            if (file_exists(ROOT . 'Application/Views/errors/404.php')) {
                require(ROOT . 'Application/Views/errors/404.php');
            } else {
                echo "Controller '{$ctrl_name}' Doesn't exists!";
            }
            die();
        }
    }
}