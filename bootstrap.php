<?php 
session_start();

require __DIR__ . '/vendor/autoload.php';

use App\Database\Connection;
use App\Classes\Post;
use App\Classes\QueryBuilder;
use App\Classes\User;


$db = Connection::connect([
    "host"=>"localhost",
    "user"=>"root",
    "password"=>"",
    "dbname"=>"blog"
]);


$query = new QueryBuilder($db);
$user = new User($db);
$post = new Post($db);

?>