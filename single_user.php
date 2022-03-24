<?php  
require_once 'bootstrap.php';

if (isset($_SESSION['logged_user'])) {
    $posts = $post->singleUserAds($_SESSION['logged_user']->id);
    require_once 'single_user_view.php';
}else{
    header ("Location:index.php");
}

?>   