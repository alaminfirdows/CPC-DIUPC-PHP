<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class SemesterActivity_Model extends Model
{

    private $semester_activities_table = 'semester_activities';

    public function insert($data)
    {

        $sql = "INSERT INTO `{$this->semester_activities_table}` (`title`, `description`, `date`, `time`, `venue`, `category`, `semester`, `status`, `createdAt`) VALUES (:title, :description, :date, :time, :venue, :category, :semester, :status,:createdAt)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE `{$this->semester_activities_table}` SET `title` = :title, `description` = :description, `date` = :date,  `time` = :time,  `venue` = :venue,  `category` = :category, `semester` = :semester, `status` = :status, `updatedAt` = :updatedAt WHERE `{$this->semester_activities_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `{$this->semester_activities_table}` WHERE `{$this->semester_activities_table}`.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function getAllActivitiesWithAllMeta()
    {
        $sql = "SELECT `{$this->semester_activities_table}`.*, `categories`.`name` as `cat_name`, `semesters`.`name` as `semester_name` FROM `{$this->semester_activities_table}` LEFT JOIN `categories` ON `{$this->semester_activities_table}`.`category` = `categories`.`id` LEFT JOIN `semesters` ON `{$this->semester_activities_table}`.`semester` = `semesters`.`id` ORDER BY `{$this->semester_activities_table}`.`id`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPublishedActivities($limit = '10')
    {
        $sql = "SELECT `{$this->semester_activities_table}`.*, `categories`.`name` as `cat_name`, `semesters`.`name` as `semester_name` FROM `{$this->semester_activities_table}` LEFT JOIN `categories` ON `{$this->semester_activities_table}`.`category` = `categories`.`id` LEFT JOIN `semesters` ON `{$this->semester_activities_table}`.`semester` = `semesters`.`id` WHERE `{$this->semester_activities_table}`.`status` = 1 ORDER BY `{$this->semester_activities_table}`.`id` DESC  LIMIT " . $limit;

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getActivityByID($id)
    {
        $sql = "SELECT * FROM `{$this->semester_activities_table}` WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }
}