<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台布局 - Layui</title>
    <link rel="stylesheet" href="{{env('HOME_URL')}}layui/css/layui.css">
    <script src="{{env('HOME_URL')}}layui/layui.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header">
        @top
        @endtop
        {{--@include('home.layout.top')--}}
    </div>
    <!--左侧-->
    <div class="layui-side layui-bg-black">
        @left
        @endleft
        {{--@include('home.layout.left')--}}
    </div>
    <!-- 内容主体区域 -->
    <div class="layui-body" style="width:800px">
        @section('content')
        @show
    </div>

</div>
</body>
</html>
<script>
    layui.use("element",function(){
        var element=layui.element;
    })
</script>