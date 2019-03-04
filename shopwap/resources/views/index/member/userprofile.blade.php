<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <title>我的潮购</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />

    <link href="{{env('STATIC_URL')}}css/comm.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/userprofile.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/buyrecord.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/single.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{env('STATIC_URL')}}css/idangerous.swiper.css">


</head>
<body>
<div class="hidehead">
    <em></em>
    <span class="title">兰兰</span>
</div>
<!-- <div class="back">
    <em></em>
</div> -->
<div class="profilehead">
    <!-- <div class="back"><em></em></div> -->
    <div class="userimg"><img src="images/goods1.jpg" alt=""></div>
    <div class="title"><p>兰兰</p></div>
</div>

<div class="listtab clearfix">
    <a href="#one" class="active">潮购记录</a>
    <a href="#two">订单状态</a>
    <a href="#three">评论</a>
</div>
<div class="swiper-container">
    <div class="liscon swiper-wrapper">
        <div class="swiper-slide">
            <div class="recordwrapp content-slide" name="one" id="one">
                @foreach($orderInfo as $k=>$v)
                    <div class="buyrecord-con clearfix">
                        <div class="record-img fl">
                            <img src="{{$v->goods_img}}" alt="订单商品图片死活出不来" style="width: 124px;height:100px">
                        </div>
                        <div class="record-con fl">
                            <h3>{{$v->goods_name}}</h3>
                            <p class="winner">订单号：<i>{{$v->order_no}}</i></p>
                            <div class="clearfix">
                                <div class="win-wrapp fl">
                                    <p class="w-time">订单生成时间:{{date("Y-m-d H:i:s")}}</p>
                                    <p class="w-chao">订单状态:{{$v->order_status}}已支付</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="swiper-slide">
            <div class="wincon content-slide" name="two" id="two">
                @foreach($orderInfo as $k=>$v)
                    <div class="buyrecord-con clearfix">
                        <div class="record-img fl">
                            <img src="{{$v->goods_img}}" alt="订单商品图片死活出不来" style="width: 124px;height:100px">
                        </div>
                        <div class="record-con fl">
                            <h3>{{$v->goods_name}}</h3>
                            <div class="clearfix">
                                <div class="win-wrapp fl">
                                    <p class="w-time">订单生成时间:{{date("Y-m-d H:i:s")}}</p>
                                    <p class="w-chao">订单状态:{{$v->order_status}}已支付</p>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div class="order clearfix">
                                <span class="fl">订单号：<i>{{$v->order_no}}
                                    </i></span>
                            <span class="fr">待发货</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-slide">
            <div id="loadingPicBlock" class="wx-show-wrapper content-slide" name="three" id="three">
                <div class="wx-show-inner content infinite-scroll" data-distance="100">
                    <div id="divPostList">

                        <div class="show-list" postid="421452">
                            <div class="show-head">
                                <a href="/v44/userpage/1010835186" class="show-u blue">厦门市</a>
                                <span class="show-time"  data-timeago="2017/7/21 14:0:0">刚刚</span>
                            </div>
                            <a href="/v44/post/detail-421452.do">
                                <h3>小米USB插线板</h3>
                            </a>
                            <a href="/v44/post/detail-421452.do">
                                <div class="show-pic">
                                    <ul class="pic-more clearfix">
                                        <li>
                                            <img src="https://img.1yyg.net/userpost/small/20170623135108386.jpg">
                                        </li>
                                        <li>
                                            <img src="https://img.1yyg.net/userpost/small/20170623135109851.jpg">
                                        </li>
                                        <li>
                                            <img src="https://img.1yyg.net/userpost/small/20170623135112131.jpg">
                                        </li>
                                    </ul>
                                </div>
                                <div class="show-con">
                                    <p name="content">中奖了，心里一个美啊，激动万分，小米USB插板，家庭办公都很实用，设计非常的到位，小巧，不占地方，包装完美，做工非…</p>
                                </div>
                            </a>
                            <div class="opt-wrapper">
                                <ul class="opt-inner">
                                    <li name="wx_zan" postid="421452">
                                        <a href="javascript:;">
                                            <span class="zan wx-new-icon"></span><em>0</em>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="{{env('STATIC_URL')}}js/jquery-1.11.2.min.js"></script>
<script src="{{env('STATIC_URL')}}js/idangerous.swiper.min.js"></script>
<script>
    // 向上滑动导航条变化
    $(window).scroll(function(){

        var scrollTop = $(this).scrollTop();

        var opacity;
        /* 透明度初始为0，随着滚动逐渐为1 */
        opacity = (scrollTop / 206 > 1) ? 1 : scrollTop / 206;

        $('.hidehead').css('background', 'rgba(242,47,47,'+opacity+')');
        if(scrollTop>=206){
            $('.hidehead span.title').css('display','block');
            $('.listtab').addClass('fix');
            $('.swiper-container').css('z-index','-1');
        }else{
            $('.hidehead span.title').css('display','none');
            $('.listtab').removeClass('fix');
            $('.swiper-container').css('z-index','0');
        }

    });
</script>
<script type="text/javascript">
    var tabsSwiper = new Swiper('.swiper-container',{
        loop: true,
        autoplay:false,
        calculateHeight:true,
        onSlideChangeStart: function(){
            $(".tabs .active").removeClass('active')
            $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active')
        }
    });

    $(".listtab a").on('touchstart mousedown',function(e){
        e.preventDefault()
        $(".listtab .active").removeClass('active')
        $(this).addClass('active')
        tabsSwiper.swipeTo( $(this).index() )
    })
    $(".listtab a").click(function(e){
        e.preventDefault()
    })
</script>
</body>
</html>
