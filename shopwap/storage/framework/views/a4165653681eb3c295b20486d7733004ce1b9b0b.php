

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品详情</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/goods.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/fsgallery.css" rel="stylesheet" charset="utf-8">
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/swiper.min.css">
    
    <style>
        .Countdown-con {padding: 4px 15px 0px;}
    </style>
</head>
<body fnav="2" class="g-acc-bg">

<div class="page-group">
    <div id="page-photo-browser" class="page">
        <!--触屏版内页头部-->
        <div class="m-block-header" id="div-header">
            <strong id="m-title">商品详情</strong>
            <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
            <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
        </div>

        <!-- 焦点图 -->
        <!-- 产品信息 -->

        <div class="pro_info">
            <h2 class="gray6">
                <?php $__currentLoopData = $goods_sku_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" id="goods_id"value="<?php echo e($v->goods_id); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </h2>
            <div class="purchase-txt gray9 clearfix">
                <li style="width: 414px; float: left; display: block;" class="clone">
                    <a href="<?php echo e($v->sku_slider_img); ?>">
                        <img src="<?php echo e($v->sku_slider_img); ?>" alt="" style="width: 410px;height:190px;">
                    </a>
                </li>
                <?php echo e($v->sku_name); ?> <span id="sku_id">爆款    绝对超值</span>
                <div>
                    价值：￥<?php echo e($v->sku_price); ?>

                    库存：<?php echo e($v->sku_stock); ?>

                </div>
            </div>
        </div>


        
        
            
            
                
                    
                        
                        

                            
                                
                            
                        
                    
                
            
        
        <div class="imgdetail">
            <div class="ann_btn">
                <a href="">图文详情<s class="fr"></s></a>
            </div>
            
        </div>

    </div>





    <div class="pro_foot">
        <a href="" class="">收藏❤</a>
        <a href="javascript:;" class="addCart">加入购物车</a>
        <a href="/pay" class="shopping">立即购买</a>
        
        <span class="fr"><i><b num="<?php echo e($buy_number_total); ?>"><?php echo e($buy_number_total); ?></b></i></span>
    </div>

</div>




</div>

<script src="<?php echo e(env('STATIC_URL')); ?>js/jquery-3.2.1.min.js"></script>
<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/swiper.min.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/photo.js" charset="utf-8"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>layui/layui.js"></script>

</body>
</html>
<script>

    $(function() {
        layui.use('layer',function(){

            //ajax 传token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //点击    加入购物车
            //车的小数字变
            $('.addCart').click(function () {
                var num = $('.fr i b').html();
                var buy_number=1;
                var goods_id=$('#goods_id').val();

                var _token=$('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"<?php echo e(url('/addcar')); ?>",
                    data:'_token='+_token+'&buy_number='+buy_number+'&goods_id='+goods_id,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status==1000) {
                            layer.msg('添加成功');
                            num++;
                           $('.fr i b').text(num);

                        }else if(json_info.status==1){
                            layer.msg('添加失败');
                        }
                    }
                })



            })
            //点击购物车
            $('.fr').click(function () {
                var buy_number = $('.fr i b').html();
                var _token=$('meta[name="csrf-token"]').attr('content');
                if (isNaN(buy_number)) {
                    buy_number = 1;
                }
                var goods_id=$('#goods_id').val();
    //            alert(goods_id);return false;
    //            var  data={};
    //            data.buy_number=buy_number;
    //            data._token=_token;

                $.ajax({
                    url:"<?php echo e(url('/cart')); ?>",
                    data:'_token='+_token+'&buy_number='+buy_number+'&goods_id='+"goods_id",
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status==1000) {
                            location.href= "<?php echo e('oldcar'); ?>";
                        }else if(json_info.status==1){
                            //alert('您还没有登录~~ 请先登录');window.location.href="<?php echo e(('/login')); ?>";
                            //layui  样式   得先layui.use
                            layer.confirm("您还没有登录~~ 请先登录",{title:'是否登录'},function(){
                                window.location.href="<?php echo e(('/login')); ?>";
                            });
                        }

                    }
                })
            })
        })
    })
</script>
