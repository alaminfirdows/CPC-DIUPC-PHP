<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Comment_Model extends Model
{
  private $posts_table = 'posts';
  private $comments_table = 'comments';

  public function getAllComments()
  {
    $sql = "SELECT * FROM `{$this->comments_table}`";
    $req = Database::getBdd()->prepare($sql);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function getAllPendingComments()
  {
    $sql = "SELECT * FROM `{$this->comments_table}` WHERE `{$this->comments_table}`.`status` = 0";
    $req = Database::getBdd()->prepare($sql);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function approveComment($id)
  {
    $sql = "UPDATE `{$this->comments_table}` SET `{$this->comments_table}`.`status` = 1 WHERE `{$this->comments_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function denyComment($id)
  {
    $sql = "UPDATE `{$this->comments_table}` SET `{$this->comments_table}`.`status` = 2 WHERE `{$this->comments_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function markSpamComment($id)
  {
    $sql = "UPDATE `{$this->comments_table}` SET `{$this->comments_table}`.`status` = 3 WHERE `{$this->comments_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }

  public function deleteComment($id)
  {
    $sql = "DELETE FROM `{$this->comments_table}` WHERE `{$this->comments_table}`.`id` = ".$id;
    $req = Database::getBdd()->prepare($sql);
    return $req->execute();
  }
}
?>