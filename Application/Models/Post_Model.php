<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Post_Model extends Model
{

    private $posts_table = 'posts';
    private $comments_table = 'comments';

    public function insertPost($data) {
        $sql = "INSERT INTO `posts` (`title`, `body`, `category`, `status`, `authorId`, `featuredImage`, `createdAt`) VALUES (:title, :body, :category, :status, :authorId, :featuredImage, :createdAt)";

        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function updatePost($id, $data)
    {
        $sql = "UPDATE `{$this->posts_table}` SET `title` = :title, `body` = :body, `category` = :category, `status` = :status, `featuredImage` = :featuredImage, `updatedAt` = :updatedAt WHERE `{$this->posts_table}`.`id` = ".$id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM `{$this->posts_table}` WHERE `{$this->posts_table}`.`id` = ".$id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM `posts`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPublishedPosts()
    {
        $sql = "SELECT * FROM `posts` WHERE `status` = 1";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }


    public function getAllPublishedPostsWithAllMeta($limit='10')
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) as `author`, `categorys`.`name` as `cat_name` FROM `posts` LEFT JOIN `categorys` ON `posts`.`category` = `categorys`.`id` LEFT JOIN `users` ON `posts`.`authorId` = `users`.`id` WHERE `posts`.`status` = 1   ORDER BY `posts`.`id` DESC LIMIT ".$limit;

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function getPopularPostsWithAllMeta($limit='10')
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) as `author`, `categorys`.`name` as `cat_name` FROM `posts` LEFT JOIN `categorys` ON `posts`.`category` = `categorys`.`id` LEFT JOIN `users` ON `posts`.`authorId` = `users`.`id` WHERE `posts`.`status` = 1 GROUP BY `posts`.`views` DESC LIMIT ".$limit;

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPostByID($id)
    {
        $sql = "SELECT * FROM `posts` WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getPostByIDWithAllMeta($id)
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) as `author`, `categorys`.`name` as `cat_name` FROM `posts` LEFT JOIN `categorys` ON `posts`.`category` = `categorys`.`id` LEFT JOIN `users` ON `posts`.`authorId` = `users`.`id` WHERE (`posts`.`status` = 1 AND `posts`.`id` = ".$id.")";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getCategoryByID($id)
    {
        $sql = "SELECT * FROM `categorys` WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function getRelatedPostByPostID($id, $limit='3')
    {
        $sql = "SELECT  `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) `author`, `categorys`.`name` as `cat_name` FROM `posts` JOIN `categorys`, `users` WHERE (`posts`.`authorId` = `users`.`id` AND `posts`.`category` = `categorys`.`id`) AND `category` = (SELECT `category` FROM `posts` WHERE `posts`.`id` = " . $id . " ) AND `posts`.`id` != " . $id . " LIMIT 3";

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertComment($comment_data) {
        $sql = "INSERT INTO `{$this->comments_table}` (`postId`, `authorId`, `subscriberId`, `body`, `status`) VALUES (:postId, :authorId, :subscriberId, :body, :status)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($comment_data);
    }


    public function getCommentsByPostID($id)
    {
        $sql = "SELECT `comments`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) AS `author`, `subscribers`.`name` AS `subscriber` FROM `comments` LEFT JOIN `users` ON `comments`.`authorId` = `users`.`id` LEFT JOIN `subscribers` ON `comments`.`subscriberId` = `subscribers`.`id` WHERE (`comments`.`postId` = ".$id." ) AND `comments`.`status` = 1";

        //echo $sql;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPostsWithCommentAndAuthor()
    {
        $sql = "SELECT `posts`.*, COUNT(`comments`.id) as `total_comment`, `users`.`firstName`, `users`.`lastName` FROM `posts` JOIN `comments`, `users`  WHERE (`posts`.`id` = `comments`.`postId` AND `posts`.`authorId` = `users`.`id`)";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPostsWithAllMeta()
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) `author`, `categorys`.`name` as `cat_name` FROM `posts` JOIN `categorys` ON `posts`.`category` = `categorys`.`id` JOIN `users` ON `posts`.`authorId` = `users`.`id`";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoryPosts($id)
    {
        $sql = "SELECT `posts`.*, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) `author`, `categorys`.`name` as `cat_name` FROM `posts` JOIN `categorys` ON `posts`.`category` = `categorys`.`id` JOIN `users` ON `posts`.`authorId` = `users`.`id` WHERE `posts`.`category` = :category";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(['category'=>$id]);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    // public function getAllPostsWithAllMeta()
    // {
    //     $sql = "SELECT `posts`.*, COUNT(`comments`.id) as `total_comment`, CONCAT(COALESCE(`users`.`firstName`,''), ' ', COALESCE(`users`.`lastName`,'')) `author`, `categorys`.`name` as `cat_name` FROM `posts` JOIN `comments`, `users`, `categorys` WHERE (`posts`.`id` = `comments`.`postId` AND `posts`.`authorId` = `users`.`id` AND `posts`.`category` = `categorys`.`id`)";
    //     $req = Database::getBdd()->prepare($sql);
    //     $req->execute();
    //     return $req->fetchAll(PDO::FETCH_OBJ);
    // }

    public function getAllCategorys()
    {
        $sql = "SELECT * FROM `categorys` WHERE `status` = 1";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function edit($id, $title, $description)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}