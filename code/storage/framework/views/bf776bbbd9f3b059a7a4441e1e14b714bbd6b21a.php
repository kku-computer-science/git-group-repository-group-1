
<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<h3 style="padding-top: 10px;"><?php echo e(trans('message.welcomeTextDashboard')); ?></h3>
<br>

<?php if(app()->getLocale() == 'en'): ?>
<h4><?php echo e(trans('message.hello')); ?> <?php echo e(Auth::user()->position_en); ?> <?php echo e(Auth::user()->fname_en); ?> <?php echo e(Auth::user()->lname_en); ?></h2>
<?php else: ?>
<h4><?php echo e(trans('message.hello')); ?> <?php echo e(Auth::user()->position_th); ?> <?php echo e(Auth::user()->fname_th); ?> <?php echo e(Auth::user()->lname_th); ?></h2>
<?php endif; ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\git-group-repository-group-1\code\resources\views/dashboards/users/index.blade.php ENDPATH**/ ?>