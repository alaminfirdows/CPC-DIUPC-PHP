<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Database
{
    private static $bdd = null;

    /* Please Set your Database Host */
    private static $host_name = 'localhost';

    /* Please Set Database Name */
    private static $db_name = 'cpc-diupc';

    /* Please Set your Database Username */
    private static $db_user_name = 'alamin';

    /* Please Set your Database Password */
    private static $db_password = 'alamin';

    private function __construct()
    { }

    public static function getBdd()
    {
        if (is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=" . self::$host_name . "; dbname=" . self::$db_name, self::$db_user_name, self::$db_password);
        }
        return self::$bdd;
    }
}