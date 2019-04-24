<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Category_Model extends Model
{
  private $categorys_table = 'categorys';


	public function insertCategory($data)
  {
    $sql = "INSERT `{$this->categorys_table}` (`name`, `url`, `status`) VALUES(:name, :url, :status)";
    $req = Database::getBdd()->prepare($sql);
    return $req->execute($data);
  }

  public function getAllCategorys()
  {
    $sql = "SELECT * FROM `{$this->categorys_table}`";
    $req = Database::getBdd()->prepare($sql);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function getCategoryData($id)
  {
    $sql = "SELECT * FROM `{$this->categorys_table}` WHERE `{$this->categorys_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public function activeCategory($id)
  {
    $sql = "UPDATE `{$this->categorys_table}` SET `{$this->categorys_table}`.`status` = 1 WHERE `{$this->categorys_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function disableCategory($id)
  {
    $sql = "UPDATE `{$this->categorys_table}` SET `{$this->categorys_table}`.`status` = 0 WHERE `{$this->categorys_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function deleteCategory($id)
  {
    $sql = "DELETE FROM `{$this->categorys_table}` WHERE `{$this->categorys_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function updateCategory($id, $data)
  {
    $sql = "UPDATE `{$this->categorys_table}` SET `name` = :name, `url` = :url, `status` = :status WHERE `{$this->categorys_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute($data);
  }

}

?>