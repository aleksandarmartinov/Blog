<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\Post;



class PostController extends MainController {

    public function postView() 
    {

        echo $this->blade->make('add_post', [])->render();
        
    }


    public function createPost() 
    {

            $post = new Post();

            $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
            $description = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
            $user_id = $_SESSION['logged_user']->id;
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $allowed = array('', 'jpg', 'jpeg', 'png', 'gif');
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $file =  time().".".$file_ext;
            
            $errormsg_array = array();
            $error_exists = false;

            if ($title == '') {
                $errormsg_array[] = "Title required";
                $error_exists = true;
            }
            
            elseif (!filter_var(htmlspecialchars($_POST['post_title']))) {
                $errormsg_array[] = "Title must be correctly written";
                $error_exists = true;
            }

            elseif ($description == '') {
                $errormsg_array[] = "Please post something";
                $error_exists = true;
            }

            elseif (!filter_var(htmlspecialchars($_POST['post_description']))) {
                $errormsg_array[] = "Post must be correctly written";
                $error_exists = true;
            }

            elseif (!preg_match('/^[a-z0-9\s].+$/i', $description)) {
                $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
                $error_exists = true;
            }

            elseif($file_size >= 1000000) {
                $errormsg_array[] = "File size too big";
                $error_exists = true;
            }

            elseif(! in_array($file_ext, $allowed)) {
                $errormsg_array[] = "Wrong picture format";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /blog/add_post");
                exit();
            } else { 
                move_uploaded_file($temp,"uploads/".$file);
                $post->createPost($title, $description, $user_id, $file);
                header("Location: /");
                exit();
             } 

    }   

    
    public function editPostView($id)
    {

        $post = new Post();
        $result = $post->findPostByIdAndUid($id, $_SESSION['logged_user']->id);

        if($result){
            echo $this->blade->make('edit_post', ['post'=>$result])->render();
        }else{
            return header("Location: /");
        }

    }


    public function editPosts($id) //ova metoda se koristi u router-u (id parametar - wild card)
    {

        $post = new Post();
        $edit_post = $post->getOne($id);

        $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
        $description = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
        // $file_size = $_FILES['file']['size'];
        // $allowed = array('', 'jpg', 'jpeg', 'png', 'gif');
        
        $errormsg_array = array();
        $error_exists = false;

        if ($title == '') {
            $errormsg_array[] = "Title required";
            $error_exists = true;
        }

        elseif (!filter_var(htmlspecialchars($_POST['post_title']))) {
            $errormsg_array[] = "Title must be correctly written";
            $error_exists = true;
        }

        elseif ($description == '') {
            $errormsg_array[] = "Please post something";
            $error_exists = true;
        }
    
        elseif (!filter_var(htmlspecialchars($_POST['post_description']))) {
            $errormsg_array[] = "Post must be correctly written";
            $error_exists = true;
        }

        elseif (!preg_match('/^[a-z0-9\s].+$/i', $description)) {
            $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
            $error_exists = true;
        }

        if ($error_exists) {
            $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
            session_write_close();
            return header("Location: /blog/edit_post/" . $id);
            exit();
        } 

        if($_FILES) {
            
            if ($edit_post->file) {
                unlink("uploads/'.$edit_post->file");
            }

            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $file =  time().".".$file_ext;

            move_uploaded_file($temp,"uploads/".$file);
        }else {
            $file = $edit_post->file;
        }
    
            $post->editPost($title, $description, $file);
            return header("Location: /");
            exit();
           
    }

    
    public function deletePost($id) 
    {

        $post = new Post();
        $post->deletePost($id);
       
        return header("Location: /blog/user");

    }


    public function singleUserPosts() 
    {

        $post = new Post();

        if (isset($_SESSION['logged_user'])) {
            $posts = $post->singleUserAds($_SESSION['logged_user']->id);
            echo $this->blade->make('user', ['posts' => $posts])->render();
        }else{
            return header ("Location: /");
        }

    }


    public function userPosts($id)
    {

        $post = new Post();
        $posts = $post->singleUserAds($id);

        echo $this->blade->make('user_posts', ['posts' => $posts])->render();

    }


    public function showPost($id)
    {

        $post = new Post();
        $result = $post->getOne($id);

        echo $this->blade->make('post', ['post' => $result])->render();

    }

}