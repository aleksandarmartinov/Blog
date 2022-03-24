<?php session_start(); ?>
<?php require_once 'partials/top.php'; ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Blogger</a>
    <ul class="navbar-nav ml-auto">
        <li>
            <a href="index.php" class="nav-item">Back to Blog</a>
        </li>
    </ul>
</nav>


<div class="jumbotron text-center">
    <h4>Login</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="login.php" method="POST">
            <?php
                if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)
                    {
	                foreach($_SESSION['ERROR_MESSAGE'] as $msg) 
                        {   
		                    echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	                    }
	                    unset($_SESSION['ERROR_MESSAGE']);
                    }
            ?>
                <input type="text" name="login_email" placeholder="Email" class="form-control" ><br>
                <input type="password" name="login_password" placeholder="Password" class="form-control"><br>
                <button class="form-control btn btn-primary" name="loginBtn">Login</button>
            </form>
        </div>
    </div>
</div>
<?php require_once 'partials/bottom.php'; ?>
