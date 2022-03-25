<?php  
require_once 'bootstrap.php';

//Delete POST
if (isset($_GET['post_id']) && isset($_SESSION['logged_user'])) {
    $post->deletePost($_GET['post_id']);
}


if (isset($_SESSION['logged_user'])) {
    $posts = $post->singleUserAds($_SESSION['logged_user']->id);
    require_once 'single_user_view.php';
}else{
    header ("Location:index.php");
}

?>   