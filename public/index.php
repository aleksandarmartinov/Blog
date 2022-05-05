<?php 
session_start(); 

require __DIR__ . '/../vendor/autoload.php';


use App\Database\Connection;
use Dotenv\Dotenv;
use Bramus\Router\Router;


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

$router->get('admin/add_post', '\App\Controllers\PostController@postView');
$router->post('admin/add_post', '\App\Controllers\PostController@createPost');
$router->get('admin/user', '\App\Controllers\PostController@singleUserPosts');
$router->get('admin/edit_post/{id}', '\App\Controllers\PostController@editPostView');
$router->post('admin/edit_post/{id}', '\App\Controllers\PostController@editPosts');
$router->post('admin/post/{id}/delete', '\App\Controllers\PostController@deletePost');

$router->get('/user_posts/{id}', '\App\Controllers\PostController@userPosts');
$router->get('/post/{id}', '\App\Controllers\PostController@showPost');


$router->before('GET|POST', 'admin/*', function() {
    if ( ! isset($_SESSION['logged_user'])) {
        return header("Location: /");
    }
});

$router->before('GET|POST', 'admin/edit_post/{id}', function($id) {
    
});

$router->run();