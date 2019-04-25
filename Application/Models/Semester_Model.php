<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Semester_Model extends Model
{
    private $semesters_table = 'semesters';


    public function insert($data)
    {
        $sql = "INSERT `{$this->semesters_table}` (`name`, `url`, `status`) VALUES(:name, :url, :status)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function getAllSemesters()
    {
        $sql = "SELECT * FROM `{$this->semesters_table}`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSemestersData($id)
    {
        $sql = "SELECT * FROM `{$this->semesters_table}` WHERE `{$this->semesters_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function active($id)
    {
        $sql = "UPDATE `{$this->semesters_table}` SET `{$this->semesters_table}`.`status` = 1 WHERE `{$this->semesters_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function disable($id)
    {
        $sql = "UPDATE `{$this->semesters_table}` SET `{$this->semesters_table}`.`status` = 0 WHERE `{$this->semesters_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `{$this->semesters_table}` WHERE `{$this->semesters_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE `{$this->semesters_table}` SET `name` = :name, `url` = :url, `status` = :status WHERE `{$this->semesters_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }
}