<?php 

namespace App\Models;


use PDO;


class Comment extends BaseModel {


    //svi komentari od jednog posta
    public function getPostComments($id)
    {

        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $comment = $query->fetchAll(PDO::FETCH_OBJ);
        return $comment;

    }

    public function getOneComment($id)
    {

        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;

    }

    public function innerJoin()         
    {
        $sql = "SELECT comments.id, name, comment, DATE_FORMAT(comments.created_at, '%d-%m-%Y') AS created_at FROM comments INNER JOIN users ON comments.user_id = users.id";
        $query = $this->db->prepare($sql);
        $query->execute();

        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
        
    }





}