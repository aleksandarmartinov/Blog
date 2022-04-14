<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Database\Connection;
use App\Classes\QueryBuilder;
use App\Classes\Post;


class PostController extends MainController {

    public function postView() {

        echo $this->blade->make('add_post', [])->render();
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

        echo $this->blade->make('user', [])->render();

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);

        if (isset($_SESSION['logged_user'])) {
            $posts = $post->singleUserAds($_SESSION['logged_user']->id);
        }else{
            header ("Location: /");
        }
    }

    public function deletePost() {

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $post = new Post($db);
        
        if (isset($_GET['post_id']) && isset($_SESSION['logged_user'])) {
            $post->deletePost($_GET['post_id']);
        }
        
    }
}