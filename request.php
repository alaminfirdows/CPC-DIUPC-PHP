<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/
class Request {
  public $url;

  public function __construct()
  {
    $this->url = $_SERVER["REQUEST_URI"];
  }
}