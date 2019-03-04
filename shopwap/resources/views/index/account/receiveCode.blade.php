<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>注册验证</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{env('STATIC_URL')}}css/comm.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/login.css" rel="stylesheet" type="text/css" />
    <link href="{{env('STATIC_URL')}}css/findpwd.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{env('STATIC_URL')}}layui/css/layui.css">
    <link rel="stylesheet" href="{{env('STATIC_URL')}}css/modipwd.css">
    <script src="{{env('STATIC_URL')}}js/jquery-1.11.2.min.js"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title"></strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



<div class="wrapper">
    <form class="layui-form" action="">
        <div class="registerCon">
            <ul>
                <li class="auth"><em>请输入验证码</em></li>
                <li><p>我们已向<em class="red">{{$tel}}</em>发送验证码短信，请查看短信并输入验证码。</p></li>
                <li>
                    @csrf
                    <input type="text" id="userMobile" placeholder="请输入验证码" value=""/>
                    <a href="javascript:void(0);" class="sendcode" id="btn">获取验证码</a>
                </li>
                <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn">确认</a></li>
                <li>换了手机号码或遗失？请致电客服解除绑定400-666-2110</li>
            </ul>
        </div>
        <input type="hidden" value="{{$pwd}}" class="pwd">
    </form>
</div>


<script src="{{env('STATIC_URL')}}layui/layui.js"></script>
<script>

    //ajax 传token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Demo
    layui.use('form', function(){
        var form = layui.form();

        //设置倒计时秒数
        var second=60;
        //设置全局变量  放定时器 方便清除定时器
        var _time;


        //点击获取验证码
        //给获取一个点击事件
        $('#btn').click(function(){
            var _this=$(this);
            //获取手机号的值
            var tel=$('.red').text();
            //console.log(tel);return false;
            //获取token值
            var _token = $("input[name=_token]").val();


                //通过ajax传给PHP页面 验证不为空  11位数字 在数据库里的唯一性
            $.ajax({
                url:'{{url('send')}}',
                data:'tel='+tel+'&_token='+_token,
                dataType:'json',
                type:'post',
                success:function(json_info){
                    //console.log(json_info);return false;
                    if(json_info.status==1000){
                        layer.msg('发送成功!请注意查收');
                        //发送请求后  将获取验证码改为60s
                        secondTelTime();

                    }else{
                        alert(json_info.msg);
                    }
                }
            });

            //发送请求后  将获取验证码改为60
            _this.text(second+'s');
            //手机秒数倒计时
            _time=setInterval(secondTelTime,1000);
        });

        //手机号发送秒数倒计时
        function secondTelTime(){
            var second=parseInt($('#btn').text());
            if(second==0){
                $('.sendcode').text('获取验证码');
                clearInterval(_time);
                //秒数为0 字样改为获取 清除定时器 a 可以再次点击
                $('.sendcode').css('pointer-events','auto');
            }else{
                //60秒正常递减
                second=second-1;
                $('.sendcode').text(second+'s');
                //发送的过程中 点击获取失效
                $('.sendcode').css('pointer-events','none');

            }
        }


        //点击确认
        $('.orangeBtn').click(function(){
            var _token = $("input[name=_token]").val();
            var tel = $('.red').text();
            var code = $('#userMobile').val();
            var pwd=$('.pwd').val();
//            var data={};
//            data.tel=tel;
//            data.code=code;
//            data._token=_token;
            $.ajax({
                url:'takeCode',
               // data:data,
                data:'tel='+tel+'&_token='+_token+'&code='+code+'&pwd='+pwd,
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.status==1000){
                        layer.msg('注册成功');
                        location.href="/login";
                    }else{
                        layer.msg(msg.msg);
                    }
                }
            })
        })
    });

</script>

</body>
</html>
