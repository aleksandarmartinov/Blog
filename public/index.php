<?php 
session_start(); 

require __DIR__ . '/../vendor/autoload.php';


use App\Database\Connection;
use Dotenv\Dotenv;
use Bramus\Router\Router;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$db = Connection::connect([
    "host"      => $_ENV['DB_HOST'],
    "user"      => $_ENV['DB_USER'],
    "password"  => $_ENV['DB_PASSWORD'],
    "dbname"    => $_ENV['DB_NAME'],
]);


// Create Router and other instances
$router = new Router();

// Define routes
$router->get('/', '\App\Controllers\IndexController@index');
$router->get('/register', '\App\Controllers\UserController@registerView');
$router->post('/register', '\App\Controllers\UserController@registerUser');
$router->get('/login', '\App\Controllers\UserController@loginView');
$router->post('/login', '\App\Controllers\UserController@loginUser');
$router->get('/add_post', '\App\Controllers\PostController@postView');
$router->post('/add_post', '\App\Controllers\PostController@createPost');
$router->get('/user', '\App\Controllers\PostController@singleUserPosts');

$router->post('/post/{id}/delete', '\App\Controllers\PostController@deletePost');

$router->get('/logout', '\App\Controllers\UserController@logout');



$router->run();