
<!DOCTYPE html>
<html lang="en">
<head>
    <title>商品列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/mui.min_1.css">
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/goods.css" rel="stylesheet" type="text/css" />
</head>

<body class="g-acc-bg" fnav="0" style="position: static">
    
    <section class="search">
        <div class="text-all dis-box j-text-all text-all-back">
            <a class="a-icon-back j-close-search" href="javascript:history.go(-1)"><i class="iconfont icon-jiantou is-left-font"></i></a>
            <div class="box-flex input-text n-input-text i-search-input">
                <a class="a-search-input j-search-input" href="javascript:void(0)"></a>
                <i class="iconfont icon-sousuo"></i>
                <input class="j-input-text" type="text" placeholder="请输入您搜索的关键词">
                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
            </div>
            <a class="a-sequence j-a-sequence"><i class="iconfont icon-pailie" data="1"></i></a>
        </div>
    </section>
    <section class="product-sequence dis-box">
        <div style="text-align: center">
            <ul>
                <li>
                    <a class="box-flex a-change" href="">默认</a>
                    <a class="box-flex" href="">销量<i class="iconfont icon-xiajiantou"></i></a>
                    <a class="box-flex" href="">人气<i class="iconfont icon-xiajiantou"></i></a>
                    <a class="box-flex" href="">价格<i class="iconfont icon-xiajiantou"></i></a>
                    <a href="#j-filter-div" class="box-flex s-filter j-s-filter">筛选</a>
                </li>
            </ul>
        </div>


            <?php $__currentLoopData = $goods_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="float:left;margin-left:20%;margin-right:30%">
                <dl><a href="<?php echo e('/goodsDetail'); ?>?cate_id=<?php echo e($v->cate_id); ?>&goods_id=<?php echo e($v->goods_id); ?>"><img src="<?php echo e(URL::asset($v->goods_img)); ?>" alt=""></a></dl>
                <dd><a href="<?php echo e('/goodsDetail'); ?>?cate_id=<?php echo e($v->cate_id); ?>&goods_id=<?php echo e($v->goods_id); ?>"><?php echo e($v->goods_name); ?></a></dd>
                <dd><?php echo e($v->goods_selfprice); ?></dd>
            </div>

            <div style="float:left">
                <dl><a href="<?php echo e('/detail'); ?>?cate_id=<?php echo e($v->cate_id); ?>&goods_id=<?php echo e($v->goods_id); ?>"><img src="<?php echo e(URL::asset($v->goods_img)); ?>" alt=""></a></dl>
                <dd><a href="<?php echo e('/detail'); ?>?cate_id=<?php echo e($v->cate_id); ?>&goods_id=<?php echo e($v->goods_id); ?>"><?php echo e($v->goods_name); ?></a></dd>
                <dd><?php echo e($v->goods_selfprice); ?></dd>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>
</html>


















