

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>

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
                    <a href="" method="GET">
                    <h3><?php echo e($post->title); ?></h3>
                    </div>
                    </a>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blogger\src\Views/index.blade.php ENDPATH**/ ?>