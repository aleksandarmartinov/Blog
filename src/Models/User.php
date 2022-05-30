<?php 

namespace App\Models;

use PDO;


class User extends BaseModel {

    public function registerUser()
    {
        $name = $_POST['register_name'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];

        $sql = "INSERT INTO users VALUES(NULL,?,?,?)";
        $query = $this->db->prepare($sql);
        $query->execute([$name, $email, $password]);
    }

    public function logUser()
    {
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$email, $password]);
        $logged_user = $query->fetch(PDO::FETCH_OBJ);

        if ($logged_user !=NULL) { 
            $_SESSION['logged_user'] = $logged_user;
        }
    }

    public function getUserWithId($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $post_owner = $query->fetch(PDO::FETCH_OBJ);
        return $post_owner;
    }
    
}
