<nav class="navbar navbar-expand navbar-light bg-light">
        <a href="index.php" class="navbar-brand">Blogger</a>
        <ul class="navbar-nav ml-auto">
            <li>
                @if(isset($_SESSION['logged_user']))
                    <li><a href="add_post_view.php" class="nav-link">Dodaj Post</a></li>
                    <li><a href="logout.php" class="nav-link">Logout</a></li>
                    <li><a href="single_user.php" class="btn btn-warning">{{ $_SESSION['logged_user']->name }}</a></li>
                @else
                    <li><a href="login_view.php" class="nav-link">Login</a></li>
                    <li><a href="/register" class="nav-link">Register</a></li>
                @endif
            </li>
        </ul>
    </nav>