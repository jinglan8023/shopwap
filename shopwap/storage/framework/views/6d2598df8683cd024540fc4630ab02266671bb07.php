<?php $__env->startSection('content'); ?>

      欢迎进入后台首页

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>