<?php

session_start();

require 'vendor/autoload.php';


use Bramus\Router\Router;
use App\Database\Connection;
use App\Classes\Post;
use App\Classes\QueryBuilder;
use App\Classes\User;
use Dotenv\Dotenv;
use Jenssegers\Blade\Blade;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$db = Connection::connect([
    "host"      => $_ENV['DB_HOST'],
    "user"      => $_ENV['DB_USER'],
    "password"  => $_ENV['DB_PASSWORD'],
    "dbname"    => $_ENV['DB_NAME'],
]);

$router = new Router();

$blade = new Blade('src/views', 'src/cache');

$router->get('/', '\App\Controllers\IndexController@index');
// $router->get('/', function() use($blade) {
//     echo $blade->make('index', ['posts' => []])->render();
// });

$router->get('about', function() {
    echo 'about';
});

// Run it!
$router->run();