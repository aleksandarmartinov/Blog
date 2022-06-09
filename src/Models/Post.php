<?php 

namespace App\Models;


use PDO;


class Post extends BaseModel {

    public function createPost(string $title, string $description, int $user_id, string $file = null)
    {

        $data = [
            'title' => $title, 
            'description' => $description, 
            'user_id' => $user_id, 
            'file' => $file, 
            'created_at' => date('Y-m-d H:i:s')
        ];

        $sql = "INSERT INTO posts (title, description, user_id, file, created_at) VALUES (:title, :description, :user_id, :file, :created_at )";
        $query = $this->db->prepare($sql);
        $query->execute($data);
        
    }

    public function singleUserAds($id)
    {
        $sql = "SELECT * FROM posts WHERE user_id= ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $posts_of_user = $query->fetchAll(PDO::FETCH_OBJ);
        return $posts_of_user;
    }

    public function editPost(string $title, string $description, string $file)
    {
        $data = [
            'title' => $title, 
            'description' => $description, 
            'file' => $file, 
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $sql ="UPDATE posts SET title=:title, description=:description, file=:file WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute($data);
    }

    public function deletePost($id) 
    {
        $sql = "DELETE FROM posts WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);     
    }

    public function findPostById($id)
    {
        $sql = "SELECT * FROM posts WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    public function findPostByIdAndUid($id, $user_id)
    {
        $sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id, $user_id]);

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query-> bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $post = $query->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    public function selectAll($table) 
    {
        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}


