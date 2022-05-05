

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron text-center">
    <h4>Register</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="/register" method="POST">

                <?php if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0): ?>

	                <?php $__currentLoopData = $_SESSION['ERROR_MESSAGE']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
		                    <div style="color: red; text-align: center;"><?php echo e($msg); ?></div><br>    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php
	                    unset($_SESSION['ERROR_MESSAGE'])
                    ?>
                    
                <?php endif; ?>
                
                <input type="name" name="register_name" placeholder="Name" class="form-control"><br>
                <input type="text" name="register_email" placeholder="Email" class="form-control"><br>
                <input type="password" name="register_password" placeholder="Password" class="form-control"><br>
                <button class="form-control btn btn-warning" name="registerBtn">Register</button>
            </form>
        </div>
    </div>
</div>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blogger\src\Views/register.blade.php ENDPATH**/ ?>