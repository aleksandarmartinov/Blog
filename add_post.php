<?php 

require_once 'bootstrap.php';

if(!isset($_SESSION['logged_user'])){
    header('Location: index.php');
}


if (isset($_POST['postSubBtn'])) {
    $post->createPost();
    header("Location: index.php");
}

?>