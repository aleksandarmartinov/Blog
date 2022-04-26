<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Database\Connection;
use App\Classes\Post;


class PostController extends MainController {

    public function postView() {

        if (isset($_SESSION['logged_user'])) {
            echo $this->blade->make('add_post', [])->render();
        }else{
            header("Location: /");
        }
    }

    public function createPost() {

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);

        if (isset($_POST['postSubBtn'])) {

            $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
            $body = $_POST['post_description'];

            $errormsg_array = array();
            $error_exists = false;

            if ($title == '') {
                $errormsg_array[] = "Title required";
                $error_exists = true;
            }
        
            if ($body == '') {
                $errormsg_array[] = "Please post something";
                $error_exists = true;
            }
        
            if (!preg_match('/^[a-z0-9\s].+$/i', $body)) {
                $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /add_post");
                exit();
             }else{
                $post->createPost();
                header("Location: /");
                exit();
             }

        }
    }   
    
    public function singleUserPosts() {

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);

        if (isset($_SESSION['logged_user'])) {
            $posts = $post->singleUserAds($_SESSION['logged_user']->id);
            echo $this->blade->make('user', ['posts' => $posts])->render();
        }else{
            header ("Location: /");
        }
    }

    public function deletePost($id) {

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);

        $post->deletePost($id);
       
        header("Location: /user");
        
    }

    public function editPostView($id)
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);
        $result = $post->findPostById($id, $_SESSION['logged_user']->id);

        if($result){
            echo $this->blade->make('edit_post', ['post'=>$result])->render();
        }else{
            return header("Location: /");
        }
    }

    public function editPost($id)
    {

        header("Location: /user");
        exit;
        
    }
}