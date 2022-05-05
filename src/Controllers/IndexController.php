<?php  

namespace App\Controllers;

use App\Controllers\MainController;
use App\Database\Connection;
use App\Classes\Post;
use App\Classes\User;


class IndexController extends MainController {

    public function index()
    {
        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $user = new User($db);
        $post = new Post($db);
        $posts = $post->selectAll('posts');
      

        echo $this->blade->make('index', ['posts' => $posts, 'user' => $user])->render();
    }

}