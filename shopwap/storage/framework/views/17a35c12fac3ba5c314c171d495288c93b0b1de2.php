<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="<?php echo e(url('/index')); ?>" class="hover"><i></i>潮购</a></li>
        <li class="f_announced"><a href="<?php echo e(url('/cate')); ?>" id="allgoods"><i></i>所有分类</a></li>
        <li class="f_single"><a href="<?php echo e(url('/newknow')); ?>" ><i></i>最新揭晓</a></li>
        <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v41/member/index.do" ><i></i>个人中心</a></li>
    </ul>
</div>
<div id="div_fastnav" class="fast-nav-wrapper">
    <ul class="fast-nav">
        <li id="li_menu" isshow="0">
            <a href="javascript:;"><i class="nav-menu"></i></a>
        </li>
        <li id="li_top" style="display: none;">
            <a href="javascript:;"><i class="nav-top"></i></a>
        </li>
    </ul>
    <div class="sub-nav four" style="display: none;">
        <a href="#"><i class="announced"></i>最新揭晓</a>
        <a href="#"><i class="single"></i>晒单</a>
        <a href="#"><i class="personal"></i>个人中心</a>
        <a href="#"><i class="shopcar"></i>购物车</a>
    </div>
</div>


</body>
</html>
<script href="<?php echo e(env('STATIC_URL')); ?>/js/jquery-1.8.3.min.js"></script>
<script>
//    $(function(){
//        $('#hover').click(function(){
//            alert(123456);
//        })
//    })
</script>