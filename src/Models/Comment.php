<?php 

namespace App\Models;


use PDO;


class Comment extends BaseModel {


    //svi komentari od jednog posta
    public function getPostComments($id)
    {

        $sql = "SELECT comments.*, users.id, users.name FROM comments JOIN users ON users.id = comments.user_id WHERE post_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;

    }

    
}