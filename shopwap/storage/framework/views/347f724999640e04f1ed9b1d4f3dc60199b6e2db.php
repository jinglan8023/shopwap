<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo e(env('STATIC_URL')); ?>css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>css/writeaddr.css">
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo e(env('STATIC_URL')); ?>dist/css/LArea.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="" class="m-index-icon" >保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">

</form> -->
<form class="layui-form" action="">

    <div class="addrcon">
        <ul>
            <li><em>收货人</em><input type="text" placeholder="请填写真实姓名" name="address_man" value="小花"></li>
            <li><em>手机号码</em><input type="number" placeholder="请输入手机号" name="address_tel" value="18910389787"></li>
            <li><em>所在区域</em><input id="demo1" type="text"  placeholder="请选择所在区域" name="address_district" value="梅花大道"></li>
            <li class="addr-detail"><em>详细地址</em><input type="text" placeholder="20个字以内" class="addr" name="address_detail" value="三弄胡同56号"></li>
        </ul>
        <div class="setnormal"><span>设为默认地址</span><input type="checkbox" name="address_default" lay-skin="switch"checked >  </div>
    </div>
</form>

<!-- SUI mobile -->
<script src="<?php echo e(env('STATIC_URL')); ?>dist/js/LArea.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>dist/js/LAreaData1.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>dist/js/LAreaData2.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>js/jquery-1.11.2.min.js"></script>
<script src="<?php echo e(env('STATIC_URL')); ?>layui/layui.js"></script>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form();
        var _token=$('meta[name="csrf-token"]').attr('content');
        var address_man=$('input[name="address_man"]').val();
        var address_tel=$('input[name="address_tel"]').val();
        var district=$('input[name="address_district"]').val();
        var address_detail=$('input[name="address_detail"]').val();
        var address_default=$('input[name="address_default"]').prop('checked');

        //监听提交

            $('.m-index-icon').click(function(){
                $.ajax({
                    url:"<?php echo e('/addressAdd'); ?>",
                    data:'_token='+_token+'&address_man='+address_man+'&address_tel='+address_tel+'&district='+district+'&address_detail='+address_detail+'&address_default='+address_default,
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                       // console.log(msg);return false;
                        if(msg.status == 1000){
                            alert('保存成功');
                            location.href="/member/address";
                        }else{
                            alert('保存失败');
                        }
                    }
                })
            return false;
        });
    });










































//    var area = new LArea();
//    area.init({
//        'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
//        'valueTo':'#value1',//选择完毕后id属性输出到该位置
//        'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
//        'type':1,//数据源类型
//        'data':LAreaData//数据源
//    });
//

</script>


</body>
</html>
