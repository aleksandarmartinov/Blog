<?php 

namespace App\Classes;

use PDO;

class Post extends QueryBuilder {

    public function createPost()
    {
        $title = $_POST['post_title'];   
        $description = $_POST['post_description'];
        $created_at = date('Y-m-d');
        $user_id = $_SESSION['logged_user']->id;

        $sql = "INSERT INTO posts VALUES (NULL,?,?,?,?)";
        $query = $this->db->prepare($sql);
        $query->execute([$title,$description,$user_id,$created_at]);

    }

    public function singleUserAds($id)
    {
        $sql = "SELECT * FROM posts WHERE user_id= ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $posts_of_user = $query->fetchAll(PDO::FETCH_OBJ);
        return $posts_of_user;
    }

    public function deletePost($id) 
    {
        $sql = "DELETE FROM posts WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);
        
    }

    public function findPostById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    public function editPost($id)
    {
        $id = $_POST['id']->id;
    }
}


