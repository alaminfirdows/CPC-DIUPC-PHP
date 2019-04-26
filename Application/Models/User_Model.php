<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class User_Model extends Model
{
    private $users_table = 'users';
    private $user_roles_table = 'user_roles';

    public function insertUser($data)
    {
        $sql = "INSERT INTO `{$this->users_table}` (`username`, `firstName`, `lastName`, `email`, `role`, `password`) VALUES (:username, :firstName, :lastName, :email, :role, :password)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function updateUser($id, $data)
    {
        $sql = "UPDATE `{$this->users_table}` SET `username` = :username, `firstName` = :firstName, `lastName` = :lastName, `email` = :email, `role` = :role, `status` = :status, `password` = :password, `updatedAt` = :updatedAt WHERE `{$this->users_table}`.`id` = ".$id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function getUser($key)
    {
        $sql = "SELECT * FROM `{$this->users_table}` WHERE (`{$this->users_table}`.`username` = '".$key."' OR `{$this->users_table}`.`email` = '".$key."')";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getAllUsers()
    {
        $sql = "SELECT `{$this->users_table}`.*, `{$this->user_roles_table}`.`name` AS `user_role` FROM `{$this->users_table}` JOIN `{$this->user_roles_table}` ON `{$this->users_table}`.`role` = `{$this->user_roles_table}`.`id`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByUserId($id)
    {
        $sql = "SELECT `{$this->users_table}`.*, `{$this->user_roles_table}`.`name` AS `user_role` FROM `{$this->users_table}` JOIN `{$this->user_roles_table}` ON `{$this->users_table}`.`role` = `{$this->user_roles_table}`.`id` WHERE `{$this->users_table}`.`id` =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getUserByPostId($id)
    {
        $sql = "SELECT `{$this->users_table}`.`firstName`, `{$this->users_table}`.`lastName` FROM `{$this->users_table}` WHERE id = (SELECT `posts`.`authorId` FROM `posts` WHERE id =" . $id .")";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getUserRoles()
    {
        $sql = "SELECT * FROM `{$this->user_roles_table}`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}