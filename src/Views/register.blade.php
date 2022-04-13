<?php require_once 'partials/top.php'; ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <a href="/" class="navbar-brand">Blogger</a>
    <ul class="navbar-nav ml-auto">
        <li>
            <a href="index.php" class="nav-item">Back to Blog</a>
        </li>
    </ul>
</nav>


<div class="jumbotron text-center">
    <h4>Register</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="/register" method="POST">
                @if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)
                    {
	                @foreach($_SESSION['ERROR_MESSAGE'] as $msg) 
                        {   
		                    echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	                    }
                    @endforeach
	                    unset($_SESSION['ERROR_MESSAGE']);
                    }
                @endif
                <input type="name" name="register_name" placeholder="Name" class="form-control"><br>
                <input type="text" name="register_email" placeholder="Email" class="form-control"><br>
                <input type="password" name="register_password" placeholder="Password" class="form-control"><br>
                <button class="form-control btn btn-warning" name="registerBtn">Register</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'partials/bottom.php'; ?>