<?php 
require_once 'bootstrap.php';

if (!isset($_SESSION['logged_user'])){
    header("Location: index.php");
}

if (isset($_SESSION['logged_user'])) {
    header("Location: index.php");
}

if(isset($_POST['registerBtn'])){

    $errormsg_array = array();
    $error_exists = false;

    if ($username == '') {
        $errormsg_array[] = "Please type in a valid username";
        $error_exists = true;
    }

    if ($email == '') {
        $errormsg_array[] = "Please type in a valid email";
        $error_exists = true;
    }

    if ($password == '') {
        $errormsg_array[] = "Please type in a valid password";
        $error_exists = true;
    }

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errormsg_array[] = "Please type your username correctly";
        $error_exists = true;
    }

    if ($error_exists) {
        $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
        session_write_close();
        header("Location: register_view.php");
        exit();
     }else{
        $user->registerUser();
        header("Location: login_view.php");
     }

}
?>