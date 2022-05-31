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

        if (isset($_POST['postSubBtn'])) {

            $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
            $body = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
            
            $errormsg_array = array();
            $error_exists = false;

            if ($title == '') {
                $errormsg_array[] = "Title required";
                $error_exists = true;
            }
        
            if ($body == '') {
                $errormsg_array[] = "Please post something";
                $error_exists = true;
            }
        
            if (!filter_var(htmlspecialchars($_POST['post_title']))) {
                $errormsg_array[] = "Title must be correctly written";
                $error_exists = true;
            }

            if (!filter_var(htmlspecialchars($_POST['post_description']))) {
                $errormsg_array[] = "Post must be correctly written";
                $error_exists = true;
            }

            if (!preg_match('/^[a-z0-9\s].+$/i', $body)) {
                $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                header("Location: /blog/add_post");
                exit();
             }else{  
                $post->createPost();
                header("Location: /");
                exit();
             }

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


    public function editPosts($id)
    {

        $post = new Post();


        if (isset($_POST['editBtn'])) {

            $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
            $body = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
            
            $errormsg_array = array();
            $error_exists = false;

            if ($title == '') {
                $errormsg_array[] = "Title required";
                $error_exists = true;
            }
        
            if ($body == '') {
                $errormsg_array[] = "Please post something";
                $error_exists = true;
            }
        
            if (!filter_var(htmlspecialchars($_POST['post_title']))) {
                $errormsg_array[] = "Title must be correctly written";
                $error_exists = true;
            }

            if (!filter_var(htmlspecialchars($_POST['post_description']))) {
                $errormsg_array[] = "Post must be correctly written";
                $error_exists = true;
            }

            if (!preg_match('/^[a-z0-9\s].+$/i', $body)) {
                $errormsg_array[] = "Post can only contain letters, numbers and white spaces";
                $error_exists = true;
            }

            if ($error_exists) {
                $_SESSION['ERROR_MESSAGE'] = $errormsg_array;
                session_write_close();
                return header("Location: /blog/edit_post/{id}");
                exit();
             }else{
                $post->editPost($id);
                return header("Location: /");
                exit();
             }

        }
              
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