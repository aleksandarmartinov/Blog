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
            $post->createPost();
            header("Location: /");
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
        exit;
        
    }
}