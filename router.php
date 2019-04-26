<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/")
        {
            $request->controller = "Home";
            $request->action = "Index";
            $request->params = [];
        }
        {
            $explode_url = explode('/', $url);
            // Please put 1 if it's your root directory otherwise leave it 2
            $explode_url = array_slice($explode_url, 2);
            if (isset($explode_url[0]) && !empty($explode_url[0])) {
               $request->controller = $explode_url[0];
            } else {
                $request->controller = "Home";
            }

            if (isset($explode_url[1]) && !empty($explode_url[1])) {
               $request->action = $explode_url[1];
            } else {
               $request->action = "Index";
            }
            
            $request->params = array_slice($explode_url, 2);
        }

    }
}
