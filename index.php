<?php 
session_start(); 

require __DIR__ . '/vendor/autoload.php';


use App\Database\Connection;
use App\Classes\Post;
use App\Classes\QueryBuilder;
use App\Classes\User;
use Dotenv\Dotenv;
use Bramus\Router\Router;
use Jenssegers\Blade\Blade;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$db = Connection::connect([
    "host"      => $_ENV['DB_HOST'],
    "user"      => $_ENV['DB_USER'],
    "password"  => $_ENV['DB_PASSWORD'],
    "dbname"    => $_ENV['DB_NAME'],
]);


// Create Router instance
$router = new Router();
$blade = new Blade('src/views', 'src/cache');

// Define routes
$router->get('/', '\App\Controllers\indexController@index');
// $router->get('/', function() use($blade) {
//     echo $blade->make('index', ['posts' => []])->render();
// });


$router->run();