<?php 


if (!isset($_SESSION['logged_user'])){
    header("Location: index.php");
}

if (isset($_SESSION['logged_user'])) {
    header("Location: index.php");
}


if(isset($_POST['loginBtn'])){

$email = $_POST['login_email'] = filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL); 
$password = $_POST['login_password'] = filter_var($_POST['login_password']);

$errormsg_array = array();
$error_exists = false;


if($email == '') {
    $errormsg_array[] = 'Please enter your Email adress';
    $error_exists = true;
}

if($password == '') {
    $errormsg_array[] = 'Please enter your password';
    $error_exists = true;
}

if($error_exists) {
    $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
    session_write_close();
    header("Location: login_view.php");
    exit();

}else{
    $user->logUser();
    header('Location: index.php');
}
}

?>
