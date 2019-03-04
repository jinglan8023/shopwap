<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/address.css">
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/sm.css">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/writeAddress" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    <?php $__currentLoopData = $user_address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="addr-list" addrss_id="<?php echo e($v->address_id); ?>">
        <ul>
            <li class="clearfix">
                <span class="fl"><?php echo e($v->address_man); ?></span>
                <span class="fr"><?php echo e($v->address_tel); ?></span>
            </li>
            <li>
                <p><?php echo e($v->district); ?><?php echo e($v->address_detail); ?></p>
            </li>
            <li class="a-set">
                <?php if($v['address_default'] ==1 ): ?>
                    <s class="z-set" style="margin-top: 6px;"></s>
                 <?php else: ?>
                    <s class="z-defalt" style="margin-top: 6px;"></s>
                <?php endif; ?>
                <span>设为默认</span>
                <div class="fr">
                    <span><a class="edit" href="/edit?address_id=<?php echo e($v->address_id); ?>">编辑</a></span>
                    <span class="remove" address_id="<?php echo e($v->address_id); ?>">删除</span>
                </div>
            </li>
        </ul>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<script src="<?php echo e(env('STATIC_URL')); ?>js/zepto.js" charset="utf-8"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/sm.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/sm-extend.js"></script>


<!-- 单选 -->
<script>


    // 删除地址
    $(document).on('click','span.remove', function () {
        var _token=$('meta[name="csrf-token"]').attr('content');

        var buttons1 = [
            {
                text: '删除',
                bold: true,
                color: 'danger',
                onClick: function() {
                    $.alert("您确定删除吗？");
                    var address_id=$('span.remove').attr('address_id');
                    $.ajax({
                        url:"<?php echo e('/remove'); ?>",
                        data:'address_id='+address_id+'&_token='+_token,
                        dataType:'json',
                        type:'post',
                        success:function(msg){
                             console.log(msg);return false;
                            if(msg.status == 1000){
                                $.alert('删除成功');
                                location.href="/member/address";
                            }else{
                                $.alert('删除失败');
                            }
                        }
                    })
                }
            }
        ];



        var buttons2 = [
            {
                text: '取消',
                bg: 'danger'
            }
        ];
        var groups = [buttons1, buttons2];
        $.actions(groups);
    });
</script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/jquery-1.8.3.min.js"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
        // jquery相关代码
        $$('.addr-list .a-set s').toggle(
                function(){
                    if($$(this).hasClass('z-set')){

                    }else{
                        $$(this).removeClass('z-defalt').addClass('z-set');
                        $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                    }
                },
                function(){
                    if($$(this).hasClass('z-defalt')){
                        $$(this).removeClass('z-defalt').addClass('z-set');
                        $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                    }

                }
        )

    });

</script>



</body>
</html>
