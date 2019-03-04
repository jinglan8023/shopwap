<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/cartlist.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>
<body id="loadingPicBlock" class="g-acc-bg">
<input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
<div>
    <!--首页头部-->
    <div class="m-block-header">
        <a href="/" class="m-public-icon m-1yyg-icon"></a>
        <a href="/" class="m-index-icon">编辑</a>
    </div>
    <!--首页头部 end-->
    <div class="g-Cart-list">
        <?php if(!empty($carInfo)&&!empty(session('user_info'))): ?>
            <ul id="cartBody">
            <?php $__currentLoopData = $carInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <s class="xuan current"   car_id="<?php echo e($v->car_id); ?>" goods_id="<?php echo e($v->goods_id); ?>"></s>
                <a class="fl u-Cart-img" href="/v44/product/12501977.do">
                    <img src="<?php echo e($v->goods_img); ?>" border="0" alt="">
                </a>
                <div class="u-Cart-r">
                    <a href="/v44/product/12501977.do" class="gray6"><?php echo e($v->goods_name); ?></a>
                    <span class="gray9">
                       ￥<em><?php echo e($v->goods_selfprice); ?></em>
                    </span>
                    <div class="num-opt">
                        <em class="num-mius dis min"><i></i></em>
                        <input class="text_box" name="num" maxlength="6" type="text" value="<?php echo e($v->buy_number); ?>" stock="<?php echo e($v->goods_stock); ?>"  car_id="<?php echo e($v->car_id); ?>" goods_id="<?php echo e($v->goods_id); ?>">
                        <em class="num-add add" car_id="<?php echo e($v->car_id); ?>" goods_id="<?php echo e($v->goods_id); ?>"><i></i></em>
                    </div>
                    <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del"><s></s></a>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php else: ?>
        <div id="divNone" class="empty"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        <?php endif; ?>
    </div>
    <div id="mycartpay" class="g-Total-bt g-car-new" style="">
        <dl>
            <dt class="gray6">
                <s class="quanxuan current"></s>全选
                <p class="money-total">合计<em class="orange total"><span>￥</span>0.00</em></p>
            </dt>
            <dd>
                <a href="javascript:;" id="all_del" class="orangeBtn w_account remove" >删除</a>
                <a href="<?php echo e('/pay'); ?>" id="all_payment" class="orangeBtn w_account">结算</a>
            </dd>
        </dl>
    </div>
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




    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="/v41/index.do" ><i></i>潮购</a></li>
            <li class="f_announced"><a href="/v41/lottery/" ><i></i>最新揭晓</a></li>
            <li class="f_single"><a href="/v41/post/index.do" ><i></i>晒单</a></li>
            <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" class="hover"><i></i>购物车</a></li>
            <li class="f_personal"><a href="/v41/member/index.do" ><i></i>我的潮购</a></li>
        </ul>
    </div>

    <script src="<?php echo e(env('STATIC_URL')); ?>js/jquery-3.2.1.min.js"></script>

    <!---商品加减算总数---->
    <script type="text/javascript">
        $(function () {
            var _token=$('meta[name="csrf-token"]').attr('content');


           //自己填写购买数量   失去焦点事件  ok
            $('.text_box').blur(function(){
                changeCarNumber( 3 , $(this) );

            })

            //type=1 是减   type=2是 加  ok
            function changeCarNumber(type,input_ele){
                var stock=parseInt( input_ele.attr('stock') );
                var buy_number=parseInt( input_ele.val() );
                if(isNaN(buy_number)){
                    buy_number=1;
                }
                if(buy_number==stock){
                    return false;
                }
                //购买数量小于1时
                if(buy_number<1){
                    buy_number=1;
                }
                //购买数量不能大于库存
                if(buy_number>stock){
                    buy_number=stock;

                }

            //发送ajax 请求   修改购物车数量
                var car_id=input_ele.attr('car_id');
                var goods_id=input_ele.attr('goods_id');
               // index=layer.load(0,{shade:[0.5,'#ccc']});
                $.ajax({
                    url:"<?php echo e('/ajaxUpdate'); ?>",
                    data:'_token='+_token+'&buy_number='+buy_number+'&car_id='+car_id+'&goods_id='+goods_id+'&type='+type,
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg.status == 1000){
                            input_ele.val( buy_number );
                        }
                    }
                })

            }


            //点击 +  发送ajax 请求   修改购物车数量ok     价格根据购买数量随之变化ok
            $(".add").click(function(){
                var t = $(this).prev();
                var car_id=$(this).attr('car_id');
                var goods_id=$(this).attr('goods_id');
                var buy_number =parseInt(t.val()) + 1;

                $.ajax({
                    url:"<?php echo e('/ajaxUpdate'); ?>",
                    data:'_token='+_token+'&buy_number='+buy_number+'&car_id='+car_id+'&goods_id='+goods_id+'&type=1',
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg.status == 1000){
                            buy_number=  t.val(parseInt(t.val()) + 1);
                        }
                    }
                })
                GetCount();
            })


            //点击 -  发送ajax 请求   修改购物车数量ok      价格根据购买数量随之变化ok
            $(".min").click(function () {
                var t = $(this).next();

                var car_id=$(this).attr('car_id');
                var goods_id=$(this).attr('goods_id');
                var buy_number =parseInt(t.val()) - 1;
                //最小为1
                if(buy_number <1 ){
                    buy_number = 1;
                }
                $.ajax({
                    url:"<?php echo e('/ajaxUpdate'); ?>",
                    data:'_token='+_token+'&buy_number='+buy_number+'&car_id='+car_id+'&goods_id='+goods_id+'&type=2',
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg.status == 1000){
                            if(t.val()>1){
                                buy_number =  t.val(parseInt(t.val()) - 1);
                                GetCount();
                            }
                        }
                    }
                })

            })

            //编辑

            //删除
            $('a[name="delLink"]').click(function(){
                var car_id=$(this).prev().find('em').attr('car_id');
                var goods_id=$(this).prev().find('em').attr('goods_id');
                $.ajax({
                    url:"<?php echo e('/ajaxUpdate'); ?>",
                    data:'_token='+_token+'&car_id='+car_id+'&goods_id='+goods_id+'&type=4',
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg.status == 1000){
                            alert('删除成功');
                            location.href="/oldcar";
                        }
                    }
                })
            })


            //批删  根据goods_id
            $('#all_del').click(function(){
                var goods_id = [];
                var car_id = [];

                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        var cid = $(this).attr('car_id');
                        var gid = $(this).attr('goods_id');

                        car_id.push(cid);
                        goods_id.push(gid);
                    }
                });

                $.ajax({
                    url:"<?php echo e('/ajaxUpdate'); ?>",
                    data:'_token='+_token+'&car_id='+car_id+'&goods_id='+goods_id+'&type=5',
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg.status == 1000){
                            alert('删除成功');
                            location.href="/oldcar";
                        }else{
                            alert('删除失败');
                        }
                    }
                })

            })


            //结算  路由order_first
            $('#all_payment').click(function(){
                //获取总价
                //将goods_id  buy_number goods_selfprice goods_img  传过去

             //var price = $(this).parent().prev('dt').find('.orange').text(); //alert(price.replace("￥",""));



            })
//


        })
    </script>




    <script>

        // 全选 价格根据购买数量随之变化    ok
        $(".quanxuan").click(function () {
            if($(this).hasClass('current')){
                $(this).removeClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        $(this).removeClass("current");
                    } else {
                        $(this).addClass("current");
                    }
                });
                GetCount();
            }else{
                $(this).addClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    $(this).addClass("current");
                     $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                });
                GetCount();
            }


        });

        // 单选 价格根据购买数量随之变化     ok
        $(".g-Cart-list .xuan").click(function () {
            if($(this).hasClass('current')){

                $(this).removeClass('current');

            }else{
                $(this).addClass('current');
            }
            if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }

            GetCount();
        });


        // 已选中的总额 ok
        function GetCount() {
            var conts = 0;
            var aa = 0;
            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    for (var i = 0; i < $(this).length; i++) {
                        var buy_number=$(this).parents('li').find('input.text_box').val();
                        var price=parseFloat($(this).parents('li').find('input.text_box').parent('.num-opt').prev().find('em').html());
                        conts += price * buy_number;
                         aa += 1;
                    }
                }

            });

            $(".total").html('<span>￥</span>'+(conts).toFixed(2));
        }
        GetCount();

    </script>
</body>
</html>
