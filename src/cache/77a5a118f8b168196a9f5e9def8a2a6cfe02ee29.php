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
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($user->getUserWithId($post->user_id)->name); ?>

                <div class="card mb-3">
                <div class="card-header">
                <h3><?php echo e($post->title); ?></h3>
                </div>
                <div class="card-body">
                    <p><?php echo e($post->description); ?></p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-sm float-right">
                        <?php echo e(date_format(date_create($post->created_at),"Y-m-d")); ?>

                    </button>
                    <button class="btn btn-warning btn-sm float-left">
                        <?php echo e($user->getUserWithId($post->user_id)->name); ?>

                    </button>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php require_once 'partials/bottom.php'; ?>

<?php /**PATH C:\xampp\htdocs\blogger\src\Views/index.blade.php ENDPATH**/ ?>