<?php 
session_start(); 

require __DIR__ . '/../vendor/autoload.php';


use Dotenv\Dotenv;
use Bramus\Router\Router;
use App\Models\Post;
use App\Controllers;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


// Create Router and other instances
$router = new Router();

// Define routes
$router->get('/', '\App\Controllers\IndexController@index');

$router->get('/register', '\App\Controllers\UserController@registerView');
$router->post('/register', '\App\Controllers\UserController@registerUser');
$router->get('/login', '\App\Controllers\UserController@loginView');
$router->post('/login', '\App\Controllers\UserController@loginUser');
$router->get('/logout', '\App\Controllers\UserController@logout');
$router->get('blog/add_post', '\App\Controllers\PostController@postView');
$router->post('blog/add_post', '\App\Controllers\PostController@createPost');
$router->get('blog/user', '\App\Controllers\PostController@singleUserPosts');
$router->get('blog/edit_post/{id}', '\App\Controllers\PostController@editPostView');
$router->post('blog/edit_post/{id}', '\App\Controllers\PostController@editPosts');
$router->post('blog/post/{id}/delete', '\App\Controllers\PostController@deletePost');
$router->get('/user_posts/{id}', '\App\Controllers\PostController@userPosts');
$router->get('/post/{id}', '\App\Controllers\PostController@showPost');
$router->post('/post/{id}', '\App\Controllers\PostController@postComment');
$router->get('/category/{id}', '\App\Controllers\PostController@postsByCategory');


$router->before('GET|POST', 'blog/*', function() {

    if ( ! isset($_SESSION['logged_user'])) {
        return header("Location: /");
    }

});

$router->before('GET|POST', 'blog/add_post', function() {

    if ( ! isset($_SESSION['logged_user'])) {
        return header("Location: /login");
    }
    
});

$router->before('GET|POST', 'blog/edit_post/{id}', function($id) {

    
    $post = new Post();
    $result = $post->findPostByIdAndUid($id, $_SESSION['logged_user']->id);

    if (! $result){
        return header("Location: /");
    }
     
});


$router->run();