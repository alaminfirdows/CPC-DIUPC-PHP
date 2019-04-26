<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

ob_start();
if (!isset($_SESSION)) {
    session_start();
}

define('WEBROOT', str_replace("Public/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . "Application/Config/db.php");
require(ROOT . "Core/Load.php");
require(ROOT . "Core/Model.php");
require(ROOT . "Core/Controller.php");

require(ROOT . 'Application/Config/core.php');

require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');

function base_url($url = '')
{
    return BASE_URL . $url;
}

function event_image_url($file = '')
{
    if ($file) return BASE_URL . 'uploads/event-images/' . $file;
    return;
}


function set_flush_data($var, $data, $type = '')
{
    if (!isset($_SESSION)) session_start();
    if ($var != '') {
        $_SESSION["flush_data"][$var]['type'] = $type;
    }
    $_SESSION["flush_data"][$var]['data'] = $data;
}

function get_flush_data($var)
{
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION["flush_data"][$var])) {
        $flush_data = $_SESSION["flush_data"][$var];
    } else {
        $flush_data = NULL;
    }
    unset($_SESSION["flush_data"][$var]);
    return $flush_data;
}

$dispatch = new Dispatcher();
$dispatch->dispatch();