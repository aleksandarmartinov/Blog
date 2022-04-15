<nav class="navbar navbar-expand navbar-light bg-light">
        <a href="/" class="navbar-brand">Blogger</a>
        <ul class="navbar-nav ml-auto">
            <li>
                @if(isset($_SESSION['logged_user']))
                    <li><a href="/add_post" class="nav-link">Dodaj Post</a></li>
                    <li><a href="/logout" class="nav-link">Logout</a></li>
                    <li><a href="/user" class="btn btn-warning">{{ $_SESSION['logged_user']->name }}</a></li>
                @else
                    <li><a href="/login" class="nav-link">Login</a></li>
                    <li><a href="/register" class="nav-link">Register</a></li>
                @endif
            </li>
        </ul>
    </nav>