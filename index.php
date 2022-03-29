<?php

session_start();

require 'vendor/autoload.php';


use Bramus\Router\Router;
use App\Database\Connection;
use App\Classes\Post;
use App\Classes\QueryBuilder;
use App\Classes\User;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$db = Connection::connect([
    "host"      => $_ENV['DB_HOST'],
    "user"      => $_ENV['DB_USER'],
    "password"  => $_ENV['DB_PASSWORD'],
    "dbname"    => $_ENV['DB_NAME'],
]);

$router = new Router();

$router->get('/', function() {
    echo 'index';
});

$router->get('about', function() {
    echo 'about';
});

// Run it!
$router->run();