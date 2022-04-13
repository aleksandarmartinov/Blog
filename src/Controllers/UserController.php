<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

use App\Controllers\MainController;
use App\Database\Connection;
use App\Classes\Post;
use App\Classes\QueryBuilder;
use App\Classes\User;


class UserController extends MainController {

    public function registerView(){

        echo $this->blade->make('register', [])->render();
    }
    

    public function registerUser() {

        $db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);

        $query = new QueryBuilder($db);
        $user = new User($db);

    
        if(isset($_POST['registerBtn'])){
       
            $username = $_POST['register_name'];
            $email = $_POST['register_email'] = filter_var($_POST['register_email'], FILTER_VALIDATE_EMAIL); 
            $password = $_POST['register_password'] = filter_var($_POST['register_password']);
        
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
                header("Location: /");
                exit();
             }else{
                $user->registerUser();
                header("Location: /");
                exit();
             }
        
        }

    }
}
    