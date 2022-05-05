<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Database\Connection;
use App\Classes\Post;
use App\Classes\User;


class PostController extends MainController {

    public function postView() 
    {
        echo $this->blade->make('add_post', [])->render();
    }


    public function createPost() 
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);

        if (isset($_POST['postSubBtn'])) {

            $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
            $body = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
            
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
        
            if (!filter_var(htmlspecialchars($_POST['post_title']))) {
                $errormsg_array[] = "Title must be correctly written";
                $error_exists = true;
            }

            if (!filter_var(htmlspecialchars($_POST['post_description']))) {
                $errormsg_array[] = "Post must be correctly written";
                $error_exists = true;
            }

            if (!preg_match('/^[a-z0-9\s].+$/i', $body)) {
                $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /admin/add_post");
                exit();
             }else{
                $post->createPost();
                header("Location: /");
                exit();
             }

        }
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
        $result = $post->findPostByIdAndUid($id, $_SESSION['logged_user']->id);

        if($result){
            echo $this->blade->make('edit_post', ['post'=>$result])->render();
        }else{
            return header("Location: /");
        }

    }


    public function editPosts($id)
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);


        //Validacija i redirekcija
        
        $post->editPost($id);
        header("Location: /");
        

    }

    
    public function deletePost($id) 
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);
        $post->deletePost($id);
       
        header("Location: /admin/user");

    }


    public function singleUserPosts() 
    {
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


    public function userPosts($id)
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);
        $posts = $post->singleUserAds($id);

        echo $this->blade->make('user_posts', ['posts' => $posts])->render();

    }


    public function showPost($id)
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);
        $result = $post->getOne($id);

        echo $this->blade->make('post', ['post' => $result])->render();

    }

}