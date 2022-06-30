<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;



class PostController extends MainController {

    //view za dodavanje posta
    public function postView() 
    {
        $post = new Post();
        $categories = $post->selectAll('categories');

        echo $this->blade->make('add_post', ['categories' => $categories])->render();
        
    }

    //kreiranje posta
    public function createPost() 
    {

        $post = new Post();
        $category = new Category();

        $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
        $description = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
        $user_id = $_SESSION['logged_user']->id;
        $cat_id = $_POST['category'];
        $cat_exists = $category->getCategory($_POST['category']);
        $start_file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $allowed = array('', 'jpg', 'jpeg', 'png', 'gif');
        $file_ext = pathinfo($start_file, PATHINFO_EXTENSION);
        $file =  time().".".$file_ext;
        
        if($start_file) {
            $file = $file;
        }else {
            $file = "";
        }

        $_SESSION['title'] = $title;
        $_SESSION['description'] = $description;

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

        elseif(! $cat_exists) {
            $errormsg_array[] = "There is no such category";
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
            $post->createPost($title, $description, $user_id,$cat_id, $file);
            header("Location: /");
            exit();
        }
         

    }   

    //view za edit
    public function editPostView($id)
    {

        $post = new Post();
        $result = $post->findPostByIdAndUid($id, $_SESSION['logged_user']->id);
        $categories = $post->selectAll('categories');

        if (! $result) {
            return header ("Location: /"); 
         }

        echo $this->blade->make('edit_post', ['categories' => $categories,'post'=>$result])->render();

    }

    //edit
    public function editPosts($id) { //ova metoda se koristi u router-u (id parametar - wild card)
    

        $post = new Post();
        $category = new Category();

        $edit_post = $post->getOne($id);
        $id = $edit_post->id;
        $title = $_POST['post_title'] = trim(htmlspecialchars($_POST['post_title']));
        $description = $_POST['post_description'] = trim(htmlspecialchars($_POST['post_description']));
        
        $cat_exists = $category->getCategory($_POST['category']);
        $cat_id = $edit_post->cat_id;
        $new_cat = $_POST['category'];
        
        $old_file = $edit_post->file;
        $new_file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $allowed = array('', 'jpg', 'jpeg', 'png', 'gif');
        $file_ext = pathinfo($new_file, PATHINFO_EXTENSION);
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

        elseif(! $cat_exists) {
            $errormsg_array[] = "There is no such category";
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
            return header("Location: /blog/edit_post/" . $id);
            exit();
        } 
      
        if($_POST['category']) {

            $cat_id = $new_cat;
        }else {
            
            $cat_id = $cat_id;
        }

        if(! empty($new_file)) {
            
            unlink("uploads/".$old_file);
            $file = $file;
            
            move_uploaded_file($temp,"uploads/".$file);
        }else {

            $file = $old_file;
        }
        
        $post->editPost($id,$title, $description,$cat_id, $file);
        return header("Location: /");
        exit();

    }

    //brisanje
    public function deletePost($id) 
    {

        $post = new Post();
        $post->deletePost($id);
       
        return header("Location: /blog/user");

    }

    //single user nalog
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

    //view za sve postove od jednog usera
    public function userPosts($id)
    {

        $post = new Post();
        $user = new User();
        
        $id = $post->findPostById($id)->user_id;
        $result = $user->getUserWithId($id)->name;
        $posts = $post->singleUserAds($id);

        echo $this->blade->make('user_posts', ['user' => $result, 'posts' => $posts])->render();

    }

    //view jednog posta sa komentarima
    public function showPost($id)
    {

        $post = new Post();
        $user = new User();
        $category = new Category();
        $comment = new Comment();

        $post_exists = $post->getOne($id);
        $cat_id = $post->getOne($id)->cat_id;
        $category = $category->getCategory($cat_id);

        $comments = $comment->getPostComments($id);

        $inner_id = $post_exists->id;
        $objects = $comment->innerJoin($inner_id);
        // $persons = $objects->user_id;




        // $id = $comment->getPostComments($id);
        // $commenter = $user->getUserWithId($id);
        // // $commenter_name = $commenter[]->name;
        print_r($objects);
        exit;

        if (! $post_exists) {
           return header ("Location: /"); 
        }
 
        echo $this->blade->make('post', ['post' => $post_exists,'category' => $category, 'comments' => $comments])->render();

    }

    //dodaj comment na post
    public function postComment($id)
    {
        $post = new Post();

        $user_id = $_SESSION['logged_user']->id;
        $targeted_post = $post->getOne($id);
        $post_id = $targeted_post->id;
        $comment = $_POST['comment'];
        
        if(! $_SESSION['logged_user']) {
            return header ("Location: /"); 
        }else {
            $post->addComment($user_id, $post_id, $comment);
            return header ("Location: /");
            exit();
        }   

    }

    //prikaz postova po kategoriji
    public function postsByCategory($id)
    {
        $post = new Post();
        $user = new User();

        $posts = $post->getCategoriesByID($id);

        if (! $posts) {
            return header ("Location: /"); 
        }

        echo $this->blade->make('category', ['user' => $user,'posts' => $posts])->render();

    }
    

}
