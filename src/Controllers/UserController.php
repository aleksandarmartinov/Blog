<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\User;


class UserController extends MainController {


    public function loginView()
    {
        echo $this->blade->make('login', [])->render();    
    }


    public function loginUser()
    {

        $user = new User();

        if(isset($_POST['loginBtn'])) {

            $email = $_POST['login_email'] = filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL); 
            $password = $_POST['login_password'];
            
            $errormsg_array = array();
            $error_exists = false;
            
            
            if($email == '') {
                $errormsg_array[] = 'Valid Email is required';
                $error_exists = true;
            }
            
            elseif($password == '') {
                $errormsg_array[] = 'Password is required';
                $error_exists = true;
            }
            
            if($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /login");
                exit();
            
            }else{
                $user->logUser();
                header("Location: /");
                exit();
            }
        }
        
    }


    public function registerView()
    {
        echo $this->blade->make('register', [])->render();
    }
    

    public function registerUser() 
    {

        $user = new User();

    
        if(isset($_POST['registerBtn'])) {
       
            $username = htmlspecialchars(stripslashes($_POST['register_name']));
            $email = $_POST['register_email']; 
            $password = $_POST['register_password'];
        
            $errormsg_array = array();
            $error_exists = false;
            $pass_number = preg_match('@[0-9]@', $password);

        
            if ($username == '') {
                $errormsg_array[] = "Username is required";
                $error_exists = true;
            }
        
            elseif ($email == '') {
                $errormsg_array[] = "Email is required";
                $error_exists = true;
            }

            elseif ($password == '') {
                $errormsg_array[] = "Password is required";
                $error_exists = true;
            }
        
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errormsg_array[] = "Please type in a valid email";
                $error_exists = true;
            }

            elseif(strlen($password) <=5 || !$pass_number){
                $errormsg_array[] = "Password must be at least 6 characters and must contain at least one number";
                $error_exists = true;
            }
        
            elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                $errormsg_array[] = "Please type your username correctly";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /register");
                exit();
             }else{
                $user->registerUser();
                header("Location: /login");
                exit();
             }
        
        }

    }


    public function logout() 
    {

    session_start();
    session_destroy();
    header("Location: /");

    }
    
}
