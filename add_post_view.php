<?php require_once 'partials/top.php'; ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <a href="" class="navbar-brand">Blogger</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
        </li>
        <li class="nav-item">
            <a href="index.php" class="nav-link">Back to Blog</a>
        </li>
    </ul>
</nav>


<div class="jumbotron text-center">
    <h4>Dodajte Post</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="add_post.php" method="POST">
            <input type="text" name="post_title" placeholder="Title" class="form-control" required><br>
            <textarea name="post_description" placeholder="Description" colls="30" rows="10" class="form-control" required></textarea><br>
            <button type="sybmit" name="postSubBtn" class="form-control btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>


<?php require_once 'partials/bottom.php'; ?>