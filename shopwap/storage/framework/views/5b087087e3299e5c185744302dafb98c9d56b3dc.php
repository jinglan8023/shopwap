<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台布局 - Layui</title>
    <link rel="stylesheet" href="<?php echo e(env('HOME_URL')); ?>layui/css/layui.css">
    <script src="<?php echo e(env('HOME_URL')); ?>layui/layui.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header">
        <?php $__env->startComponent('home.layout.top'); ?>
        <?php echo $__env->renderComponent(); ?>
        
    </div>
    <!--左侧-->
    <div class="layui-side layui-bg-black">
        <?php $__env->startComponent('home.layout.left'); ?>
        <?php echo $__env->renderComponent(); ?>
        
    </div>
    <!-- 内容主体区域 -->
    <div class="layui-body" style="width:800px">
        <?php $__env->startSection('content'); ?>
        <?php echo $__env->yieldSection(); ?>
    </div>

</div>
</body>
</html>
<script>
    layui.use("element",function(){
        var element=layui.element;
    })
</script>