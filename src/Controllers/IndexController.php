<?php  

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\Post;
use App\Models\User;


class IndexController extends MainController {

    public function index()
    {

        $user = new User();
        $post = new Post();
        $posts = $post->selectAll('posts');
      

        echo $this->blade->make('index', ['posts' => $posts, 'user' => $user])->render();
    }

}