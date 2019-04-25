<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Event_Model extends Model
{

    private $events_table = 'events';

    public function insert($data)
    {
        $sql = "INSERT INTO `posts` (`title`, `body`, `category`, `status`, `authorId`, `featuredImage`, `createdAt`) VALUES (:title, :body, :category, :status, :authorId, :featuredImage, :createdAt)";

        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE `{$this->posts_table}` SET `title` = :title, `body` = :body, `category` = :category, `status` = :status, `featuredImage` = :featuredImage, `updatedAt` = :updatedAt WHERE `{$this->posts_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `{$this->posts_table}` WHERE `{$this->posts_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function getAllEvents()
    {
        $sql = "SELECT `{$this->events_table}`.*, `categories`.`name` as `cat_name`, `semesters`.`name` as `semester_name` FROM `{$this->events_table}` LEFT JOIN `categories` ON `{$this->events_table}`.`category` = `categories`.`id` LEFT JOIN `semesters` ON `{$this->events_table}`.`category` = `semesters`.`id` LEFT JOIN `users` ON `{$this->events_table}`.`authorId` = `users`.`id` ORDER BY `{$this->events_table}`.`id` DESC";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPublishedEvents($limit = '10')
    {
        $sql = "SELECT `{$this->events_table}`.*, `categories`.`name` as `cat_name`, `semesters`.`name` as `semester_name` FROM `{$this->events_table}` LEFT JOIN `categories` ON `{$this->events_table}`.`category` = `categories`.`id` LEFT JOIN `semesters` ON `{$this->events_table}`.`category` = `semesters`.`id` LEFT JOIN `users` ON `{$this->events_table}`.`authorId` = `users`.`id` WHERE `{$this->events_table}`.`status` = 1 ORDER BY `{$this->events_table}`.`id` DESC  LIMIT " . $limit;

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEventByID($id)
    {
        $sql = "SELECT * FROM `{$this->events_table}` WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getEventByIDWithAllMeta($id)
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) as `author`, `categorys`.`name` as `cat_name` FROM `posts` LEFT JOIN `categorys` ON `posts`.`category` = `categorys`.`id` LEFT JOIN `users` ON `posts`.`authorId` = `users`.`id` WHERE (`posts`.`status` = 1 AND `posts`.`id` = " . $id . ")";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }
}
