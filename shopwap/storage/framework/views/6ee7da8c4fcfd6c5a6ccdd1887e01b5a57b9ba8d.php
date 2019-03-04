<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>潮购记录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/buyrecord.css">
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/userprofile.css">


</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">潮购记录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="buycart"></i></a>
</div>


<div class="nocontent">
    <div class="m_buylist m_get">
        <ul id="ul_list">
            <?php if(empty($orderInfo)): ?>
                <div class="noRecords colorbbb clearfix">
                    <s class="default"></s>您还没有购买商品哦~
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $orderInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="buyrecord-con clearfix">
                        <div class="record-img fl">
                            <img src="<?php echo e($v->goods_img); ?>" alt="订单商品图片死活出不来" style="width: 124px;height:100px">
                        </div>
                        <div class="record-con fl">
                            <h3><?php echo e($v->goods_name); ?></h3>
                            <p class="winner">订单号：<i><?php echo e($v->order_no); ?></i></p>
                            <div class="clearfix">
                                <div class="win-wrapp fl">
                                    <p class="w-time">订单生成时间:<?php echo e(date("Y-m-d H:i:s")); ?></p>
                                    <p class="w-chao">订单状态:<?php echo e($v->order_status); ?>已支付</p>
                                </div>
                                <div class="fr"><a href="/userprofile">查看详情</a></div>
                            </div>


                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <div class="hot-recom">
                <div class="title thin-bor-top gray6">
                    <span><b class="z-set"></b>人气推荐</span>
                    <em></em>
                </div>
                <div class="goods-wrap thin-bor-top">
                    <ul class="goods-list clearfix">
                        <li>
                            <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                                <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                            </p>
                            <ins class="gray9">价值:￥7130</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="" class="g-pic">
                                <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="https://m.1yyg.com/v44/products/23458.do">(第368671潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                            </p>
                            <ins class="gray9">价值:￥7130</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:45%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                                <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                            </p>
                            <ins class="gray9">价值:￥7130</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                                <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="https://m.1yyg.com/v44/products/23458.do">(第368671潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                            </p>
                            <ins class="gray9">价值:￥7130</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </ul>
    </div>
</div>


<script src="<?php echo e(env('STATIC_URL')); ?>js/jquery-1.11.2.min.js"></script>




</body>
</html>
