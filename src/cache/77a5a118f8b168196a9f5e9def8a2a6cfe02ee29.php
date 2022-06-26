

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron text-center">
    <h4>Welcome to Blogger</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="text-center">Categories</h2><br>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><a href="/category/<?php echo e($category->id); ?>">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info">
                                <?php echo e($category->category); ?>

                            </li>
                        </ul>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div><br><br>
    <h2 class="text-center">All Posts</h2><br>
    <div class="row">
        <div class="col-8 offset-2">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3">
                    <div class="card-header"><a href="/post/<?php echo e($post->id); ?>"><h3><?php echo e($post->title); ?></h3></a></div>
                    <div class="card-body"><p><?php echo e($post->description); ?></p></div>
                    <div class="card-footer">
                        <button class="btn btn-info btn-sm float-right">
                            <?php echo e(date_format(date_create($post->created_at),"Y-m-d")); ?>

                        </button>
                        <a href="/user_posts/<?php echo e($post->user_id); ?>" class="btn btn-warning btn-sm float-left">
                            <?php echo e($user->getUserWithId($post->user_id)->name); ?>

                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blogger\src\Views/index.blade.php ENDPATH**/ ?>