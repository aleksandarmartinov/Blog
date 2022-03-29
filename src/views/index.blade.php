<?php require_once 'partials/top.php'; ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Blogger</a>
    <ul class="navbar-nav ml-auto">
        <li>
            <?php if(isset($_SESSION['logged_user'])): ?>
                <li><a href="add_post_view.php" class="nav-link">Dodaj Post</a></li>
                <li><a href="logout.php" class="nav-link">Logout</a></li>
                <li><a href="single_user.php" class="btn btn-warning"><?php echo $_SESSION['logged_user']->name; ?></a></li>
            <?php else: ?>
                <li><a href="login_view.php" class="nav-link">Login</a></li>
                <li><a href="register_view.php" class="nav-link">Register</a></li>
            <?php endif; ?>
        </li>
    </ul>
</nav>

<div class="jumbotron text-center">
    <h4>Posts</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @foreach($posts as $post)
            {{ $user->getUserWithId($post->user_id)->name }}
                <div class="card mb-3">
                <div class="card-header">
                <h3>
                    {{ $post->title }}
                    <small class="float-right">
                        <?php if(isset($_SESSION['logged_user']) && $post->user_id == $_SESSION['logged_user']->id): ?>
                        <a href="index.php?post_id=<?php echo $post->id; ?>" class="btn btn-sm btn-danger">Remove</a>
                        <?php endif; ?>
                    </small>
                </h3>
                </div>
                <div class="card-body">
                    <p><?php echo $post->description; ?></p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-sm float-right">
                        <?php $date = date_create($post->created_at); echo date_format($date,"Y-m-d"); ?>
                    </button>
                    <button class="btn btn-warning btn-sm float-left">
                        <?php echo $user->getUserWithId($post->user_id)->name; ?>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<?php require_once 'partials/bottom.php'; ?>


    
