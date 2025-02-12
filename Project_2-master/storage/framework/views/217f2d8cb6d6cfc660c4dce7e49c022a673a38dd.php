<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<h3 style="padding-top: 10px;">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
<br>
<h4>สวัสดี <?php echo e(Auth::user()->position_th); ?> <?php echo e(Auth::user()->fname_th); ?> <?php echo e(Auth::user()->lname_th); ?></h2>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project_2-master\Project_2-master\resources\views/dashboards/users/index.blade.php ENDPATH**/ ?>