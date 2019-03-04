﻿﻿<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>登录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/login.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/vccode.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(env('STATIC_URL')); ?>layui/css/layui.css" rel="stylesheet" type="text/css" />
    
    <script  type='text/javascript'src="<?php echo e(env('STATIC_URL')); ?>layui/layui.js"></script>
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <?php echo csrf_field(); ?>
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtPassword" type="password" placeholder="密码" value="" maxlength="20" /><b></b>
                    </dl>
                </li>
            </ul>
            <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a><b></b><a href="https://m.1yyg.com/v44/passport/register.do?forward=https%3a%2f%2fm.1yyg.com%2fv44%2fmember%2f">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: block;">

        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>

<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v44/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>
</body>
</html>
<script  type='text/javascript'src="<?php echo e(env('STATIC_URL')); ?>js/jquery-1.11.2.min.js"></script>

<script  type='text/javascript'src="<?php echo e(env('STATIC_URL')); ?>js/Common.js"></script>


<script>
    //ajax 传token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#btnLogin').click(function(){
        var _token = $("input[name=_token]").val();

        var user_name=$('#txtAccount').val();

        if( user_name == '' ){
            alert('手机号或邮箱不能为空！');
            return false;
        }
        var user_pwd=$('#txtPassword').val();
        if( user_pwd =='' ){
            alert('密码不能为空');
            return false;
        }

        //ajax提交
        $.ajax({
            url:'<?php echo e(url('/login')); ?>',
            data:'user_name='+user_name+'&user_pwd='+user_pwd+'&_token='+_token,
            dataType:'json',
            type:'post',
            success:function(json_info){
                if( json_info.status == 1000 ){
                    alert('登陆成功');
                    location.href='<?php echo e(url('/index')); ?>';
                }else{
                    alert(json_info.msg);
                }
            }

        })
        return false;

    })
</script>
