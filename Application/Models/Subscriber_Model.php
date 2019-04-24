<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Subscriber_Model extends Model
{
    private $subscribers_table = 'subscribers';

    public function insertSubscriberForComment($subscriber_data)
    {
        $sql = "INSERT INTO `{$this->subscribers_table}` (`name`, `email`, `ip`) VALUES (:name, :email, :ip)";
        $req = Database::getBdd()->prepare($sql);
        $req->execute($subscriber_data);

        $sql = "SELECT LAST_INSERT_ID() as `subscriberId`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}

?>