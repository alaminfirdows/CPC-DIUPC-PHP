<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Controller
{
    var $vars = [];
    var $layout = "default";

    protected function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    protected function set_layout($d)
    {
        $this->layout = $d;
    }

    protected function view($filename, $data = '')
    {
        if (is_array($data) && !empty($data)) {
            $this->vars = array_merge($this->vars, $data);
        }

        $sql = "SELECT * FROM `categorys` WHERE `categorys`.`status` = 1";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $blog_categorys = $req->fetchAll(PDO::FETCH_OBJ);
        
        extract($this->vars);
        ob_start();
        if (file_exists(ROOT . "Application/Views/" . $filename . '.php')) {
            require(ROOT . "Application/Views/" . $filename . '.php');
        } else {
            echo "View '{$filename}' Dosen't exists!";;
            die();
        }
    }

    protected function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }

    protected function load_model($model_name)
    {
        if (file_exists(ROOT . "Application/Models/" . ucfirst($model_name) . '.php')) {
            require(ROOT . "Application/Models/" . ucfirst($model_name) . '.php');
            return new $model_name();
        } else {
            echo "Model '{$model_name}' Dosen't exists!";;
            die();
        }
        
    }
}