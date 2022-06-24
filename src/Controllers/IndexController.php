<?php  

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;


class IndexController extends MainController {

    public function index()
    {

        $user = new User();
        $post = new Post();
        $category = new Category();
        $posts = $post->selectAll('posts');
        $categories = $category->selectAll('categories');      

        echo $this->blade->make('index', ['posts' => $posts, 'user' => $user, 'categories' => $categories])->render();
    }

}