

@extends('layout.main')

@section('title',$title)

@section('content')


    <div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
        <div class="app-icon">
            <a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
            <a href="javascript:;" class="info-icon">
                <i class="set-icon"></i>
                <div class="info">
                    <p>点击关注666潮人购官方微信^_^</p>
                </div>
            </a>
        </div>
    </div>
    {{--layui的不行--}}
    {{--<link rel="stylesheet" href="{{env('STATIC_URL')}}layui/css/layui.css" media="all">
    <div class="layui-carousel" id="test1">
        <div carousel-item>
            @foreach($imgInfo as $v)
            <div>
                <a href="{{URL::asset($v->slider_title)}}">
                    <img src="{{URL::asset($v->slider_img)}}" alt="">
                </a>
            @endforeach
            </div>
        </div>
    </div>

    <script src="{{env('STATIC_URL')}}layui/layui.js"></script>
    <script>
        layui.use('carousel', function(){
            var carousel = layui.carousel;
            //建造实例
            carousel.render({
                elem: '#test1'
                ,width: '100%' //设置容器宽度
                ,arrow: 'always' //始终显示箭头
                //,anim: 'updown' //切换动画方式
            });

            //监听轮播切换事件
            carousel.on('change(test1)', function(obj){ //test1来源于对应HTML容器的 lay-filter="test1" 属性值
                console.log(obj.index); //当前条目的索引
                console.log(obj.prevIndex); //上一个条目的索引
                console.log(obj.item); //当前条目的元素对象

        })
    </script>--}}
    <!-- 焦点图   轮播图-->
    <div class="hotimg-wrapper">
        <div class="hotimg-top"></div>
        <section id="sliderBox" class="hotimg">
            <ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">

                @foreach($imgInfo as $v)
                <li style="width: 414px; float: left; display: block;" class="">
                    <a href="{{URL::asset($v->slider_title)}}">
                        <img src="{{URL::asset($v->slider_img)}}" alt="">
                    </a>
                </li>
                @endforeach

            </ul>
        </section>
    </div>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
    <script src="{{env('STATIC_URL')}}layui/layui.js"></script>
 <script>
        $(function () {
         $('.hotimg').click({
         directionNav: true,   //是否显示左右控制按钮
         controlNav: true,   //是否显示底部切换按钮
         pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
         animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
         slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
         animationSpeed: 150,   //轮播效果切换时间,默认600ms
         direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
         randomize: false,   //是否随机幻切换
         animationLoop: true   //是否循环滚动
         });
         setTimeout($('.flexslider img').fadeIn());
         });

    </script>
    <!--分类-->
    <div class="index-menu thin-bor-top thin-bor-bottom">
        <ul class="menu-list">
            <li>
                <a href="javascript:;" id="btnNew">
                    <i class="xinpin"></i>
                    <span class="title">新品</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnRecharge">
                    <i class="chongzhi"></i>
                    <span class="title">充值</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnLimitbuy">
                    <i class="contact"></i>
                    <span class="title">联系我们</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnDownApp">
                    <i class="xiazai"></i>
                    <span class="title">下载APP</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnAllGoods">
                    <i class="fenlei"></i>
                    <span class="title">晒单</span>
                </a>
            </li>
        </ul>
    </div>
    <!--导航-->
    <div class="success-tip">
        <div class="left-icon"></div>
        <ul class="right-con">
            <li>
                            <span style="color: #4E555E;">
                                <a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
                            </span>
            </li>
            <li>
                            <span style="color: #4E555E;">
                                <a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
                            </span>
            </li>
            <li>
                            <span style="color: #4E555E;">
                                <a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
                            </span>
            </li>
        </ul>
    </div>
    <!-- 倒計時 -->
    <div class="endtime">
        <ul class="endtime-list clearfix">
            <li>
                <a href="" class="endtime-img"><img src="{{env('STATIC_URL')}}/images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="{{env('STATIC_URL')}}/images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="{{env('STATIC_URL')}}/images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="{{env('STATIC_URL')}}/images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time"  value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- 热门推荐 -->
    <div class="line hot">
        <div class="hot-content">
            <i></i>
            <span>潮人推荐</span>
            <div class="l-left"></div>
            <div class="l-right"></div>
        </div>
    </div>
    <div class="hot-wrapper">
        <ul class="clearfix">
            <li style="border-right:1px solid #e4e4e4; ">
                <a href="">
                    <p class="title">洋河 蓝色经典 海之蓝42度</p>
                    <p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
                    <img src="{{env('STATIC_URL')}}/images/goods2.jpg" alt="">
                </a>
            </li>
            <li style="border-right:1px solid #e4e4e4; ">
                <a href="">
                    <p class="title">洋河 蓝色经典 海之蓝42度</p>
                    <p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
                    <img src="{{env('STATIC_URL')}}/images/goods2.jpg" alt="">
                </a>
            </li>
        </ul>
    </div>
    <!-- 猜你喜欢 -->
    <div class="line guess">
        <div class="hot-content">
            <i></i>
            <span>猜你喜欢</span>
            <div class="l-left"></div>
            <div class="l-right"></div>
        </div>
    </div>
    <!--商品列表-->
    <div class="goods-wrap marginB">
        <ul id="demo"  class="goods-list clearfix">
            <ul>

            </ul>
        </ul>
        {{--<div class="loading clearfix"><b></b>正在加载</div>--}}
    </div>

    <script src="{{env('STATIC_URL')}}/js/jquery-1.11.2.min.js"></script>
    <script src="{{env('STATIC_URL')}}/layui/layui.js"></script>
    <script src="{{env('STATIC_URL')}}/js/all.js"></script>
    <script src="{{env('STATIC_URL')}}/js/index.js"></script>
    <script src="{{env('STATIC_URL')}}/js/lazyload.min.js"></script>
    <script>
          //流加载
            layui.use('flow', function(){
                var $=layui.jquery;
                var flow = layui.flow;
                flow.load({
                    elem: '#demo' //指定列表容器
                    //,isAuto:true
                    ,isLazyimg:true
                    ,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
                        var lis = [];
                        //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
                        $.get('{{url('productList')}}?page='+page, function(res){
                            next(res.view_content, page < res.page_count);
                        });
                    }
                });
            });
            //点击购物车小车图标  红圈里的小1像抛物线一样抛到购物车上去
//            $('.gRate').click(function(){
//                //alert(12);return false;
//                $('.shopcart').append("<b num='1'>1</b>");
//
//            })
    </script>

@endsection





















