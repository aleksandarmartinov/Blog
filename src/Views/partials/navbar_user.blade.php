<nav class="navbar navbar-expand navbar-light bg-light">
    <a href="/" class="navbar-brand">Blogger</a>
    <ul class="navbar-nav ml-auto">
        <li>
            <li><a href="/" class="nav-link">Naslovna</a></li>
            <li><a href="/admin/add_post" class="nav-link">Dodaj Post</a></li>
            <li><a href="/logout" class="nav-link">Logout</a></li>
            <li><a href="" class="btn btn-warning">{{ $_SESSION['logged_user']->name }}</a></li>      
        </li>
    </ul>
</nav>