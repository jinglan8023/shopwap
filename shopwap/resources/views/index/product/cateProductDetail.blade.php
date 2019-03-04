

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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{env('STATIC_URL')}}css/comm.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/goods.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/fsgallery.css" rel="stylesheet" charset="utf-8">
    <link rel="stylesheet" href="{{env('STATIC_URL')}}css/swiper.min.css">

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
                @foreach( $goods_sku_info as $v)
                    <input type="hidden" id="goods_id"value="{{$v->goods_id}}">
                @endforeach
            </h2>
            <div class="purchase-txt gray9 clearfix">
                <li style="width: 414px; float: left; display: block;" class="clone">
                    @foreach( $goods_sku_info as $v)
                    <a href="{{$v->sku_slider_img}}">
                        <img src="{{$v->sku_slider_img}}" alt="" style="width: 410px;height:190px;">
                    </a>
                    @endforeach
                </li>
                @foreach( $goods_sku_info as $v)
                {{$v->sku_name}} <span id="sku_id">爆款    绝对超值</span>
                @endforeach
                <div>
                    @foreach( $goods_sku_info as $v)
                    价值：￥{{$v->sku_price}}
                    库存：{{$v->sku_stock}}
                    @endforeach
                </div>
            </div>
        </div>


        {{--属性--}}
        {{--<div id="divLotteryTime" class="Countdown-con">--}}
            {{--<p class="declare">属性</p>--}}
            {{--@foreach($attr as $value)--}}
                {{--<div id="divLotteryTime" class="Countdown-con">--}}
                    {{--<ul>--}}
                        {{--<li class="fl" sale_id="{{$value['sale_attr_id']}}"style="width:500px;">{{$value['sale_attr_name']}}:</li>--}}
                        {{--@foreach( $value['son'] as $key=>$vv)--}}

                            {{--echo '<li value_id='.$key.'>'.$vv.'--}}
                                {{--<div class="ch_img"></div></li>';--}}
                            {{--?>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
        <div class="imgdetail">
            <div class="ann_btn">
                <a href="">图文详情<s class="fr"></s></a>
            </div>
        </div>

    </div>





    <div class="pro_foot">
        <a href="" class="">收藏❤</a>
        <a href="#" class="addCart">加入购物车</a>
        <a href="/order_first" class="shopping">立即购买</a>
        {{--车--}}
        <span class="fr"><i><b num="1">1</b></i></span>
    </div>

</div>




</div>

<script src="{{env('STATIC_URL')}}js/jquery-3.2.1.min.js"></script>
<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
<script src="{{env('STATIC_URL')}}js/swiper.min.js"></script>
<script src="{{env('STATIC_URL')}}js/photo.js" charset="utf-8"></script>
<script src="{{env('STATIC_URL')}}layui/layui.js"></script>

</body>
</html>
<script>

    $(function() {

        //ajax 传token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //点击加入购物车
        //车的小数字变
        $('.addCart').click(function () {
            var num = $('.fr i b').html();
            num++;
            var number = $('.fr i b').html(num);
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
                url:"{{url('/cart')}}",
                data:'_token='+_token+'&buy_number='+buy_number+'&goods_id='+"goods_id",
                dataType:'json',
                type:'post',
                success:function(json_info){
                    if(json_info.status==1000) {
                        window.location.href="{{('/v44/mycart/index.do')}}";
                    }else{
                        layer.confirm('您还没有登录~~ 请先登录');
                        window.location.href="{{('/login')}}";
                    }

                }
            })

        })
    })
</script>
