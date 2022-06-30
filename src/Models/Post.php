<?php 

namespace App\Models;


use PDO;


class Post extends BaseModel {

    //create
    public function createPost(string $title, string $description, int $user_id, int $cat_id, string $file = null)
    {

        $data = [
            'title' => $title, 
            'description' => $description, 
            'user_id' => $user_id,
            'cat_id' => $cat_id,
            'file' => $file, 
            'created_at' => date('Y-m-d H:i:s')
        ];

        $sql = "INSERT INTO posts (title, description, user_id, cat_id, file, created_at) VALUES (:title, :description, :user_id, :cat_id, :file, :created_at )";
        $query = $this->db->prepare($sql);
        $query->execute($data);
        
    }

    //svi postovi usera
    public function singleUserAds($id)
    {

        $sql = "SELECT * FROM posts WHERE user_id= ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $posts_of_user = $query->fetchAll(PDO::FETCH_OBJ);
        return $posts_of_user;

    }

    //samo jedan post od usera
    public function findPostById($id)
    {

        $sql = "SELECT * FROM posts WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;

    }

    //post po id & user_id
    public function findPostByIdAndUid($id, $user_id)
    {

        $sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id, $user_id]);

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;

    }

    //post po svom id-u
    public function getOne($id)
    {

        $sql = "SELECT * FROM posts WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query-> bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;

    }

    //update post
    public function editPost(int $id,string $title, string $description,int $cat_id, string $file)
    {
        
        $data = [
            'id' => $id,
            'title' => $title,
            'description' => $description, 
            'cat_id' => $cat_id,
            'file' => $file, 
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $sql ="UPDATE posts SET id=:id, title=:title, description=:description, cat_id=:cat_id, file=:file WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute($data);

    }

    //brisanje posta
    public function deletePost($id) 
    {

        $sql = "DELETE FROM posts WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]); 

    }

    //sve iz bilo koje tabele
    public function selectAll($table) 
    {

        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
        
    }

    //svi postovi po id kategorije
    public function getCategoriesByID($id)
    {

        $sql = "SELECT * FROM posts WHERE cat_id= ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;

    }

    //dodaj comment
    public function addComment($user_id, $post_id, $comment)
    {
        $data = [
            'user_id' => $user_id, 
            'post_id' => $post_id, 
            'comment' => $comment, 
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        $sql = "INSERT INTO comments (user_id, post_id, comment, created_at) VALUES (:user_id, :post_id, :comment, :created_at)";
        $query = $this->db->prepare($sql);
        $query->execute($data);
    }

}


