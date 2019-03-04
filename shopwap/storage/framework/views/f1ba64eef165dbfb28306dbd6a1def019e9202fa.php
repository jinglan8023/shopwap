<?php $__env->startSection('content'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>轮播图添加</title>
    <link rel="stylesheet" href="<?php echo e(env('HOME_URL')); ?>layui/css/layui.css" media="all">
    <script src="<?php echo e(env('HOME_URL')); ?>layui/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(env('HOME_URL')); ?>layui/layui.js"></script>

</head>
<body>
<form class="layui-form" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">

        <div class="layui-tab-content" style="height:100px;">

            <div class="layui-tab-item layui-show">
                <div>
                    <?php echo csrf_field(); ?>
                    <div class="layui-form-item">
                        <label class="layui-form-label">轮播图标题</label>
                        <div class="layui-input-inline">
                            <input name="slider_title" class="layui-input" type="text" required placeholder="单行输入">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">轮播图链接</label>
                        <div class="layui-input-inline">
                            <input name="slider_link" class="layui-input" type="text" required placeholder="单行输入">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">轮播图排序</label>
                        <div class="layui-input-inline">
                            <input name="slider_score" class="layui-input" type="text" required placeholder="0-100,越大越优先展示">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">轮播图片</label>
                            <input type="hidden"  id="slider_img" name="slider_img">
                            <button type="button" class="layui-btn" id="file">
                                <i class="layui-icon"></i>上传图片
                            </button>
                        </div>
                    </div>
                </div>

                <!--立即提交-->
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="*" lay-submit="">立即提交</button>
                    <button class="layui-btn layui-btn-primary" type="reset">取消</button>
                </div>

            </div>
        </div>
</form>

</body>
</html>

<script>


    $(function(){

        //ajax 传token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //阻止提交
        layui.use(['form','layer','upload'], function(){
            var form = layui.form;
            var layer=layui.layer;
            var upload=layui.upload;

            //获取token 值
                var _token = $("input[name=_token]").val();
                //获取轮播图标题的值
                var slider_title=$("input[name=slider_title]").val();
                //获取轮播图链接
                var slider_link=$("input[name=slider_link]").val();
                //获取轮播图排序的值
                var slider_score=$("input[name=slider_score]").val();
                //隐藏域图片的值
                var _file=$("input[name=slider_img]").val();



            //js表单验证
//            form.verify({
//                //验证商品
//                slider_title: function(value, item) {
//                    var font;
//                    if(value==''){
//                        return "轮播图标题不能为空";
//                    }
//                }
//            });

            //商品图片  文件上传
            upload.render({
                elem: '#file' //绑定元素
                ,url: '<?php echo e(url('/img')); ?>' //上传接口
                ,data:'file='+_file
                ,dataType:'json'
                ,done: function(res, index, upload){ //上传后的回调
                    //console.log(res)
                    layer.msg(res.font,{icon:res.code});
                    //console.log(res.src)
                    if(res.code==1){
                        $('#slider_img').val(res.src);
                    }

                }
                ,accept:'images'//允许文件上传类型
                ,size:1000//最大允许上传的文件大小

            })

            //监听提交  通过ajax提交 不走action提交
            form.on('submit(*)',function(data){
//
                console.log(data.field);
                $.ajax({
                    url:'<?php echo e(url('/sliderAdd')); ?>',//路由名
                    //data:'slider_title='+slider_title+'&slider_link='+slider_link+'&slider_score='+slider_score+'&_token='+_token,
                    data:data.field,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if( json_info.status == 1000 ){
                            alert('添加成功');
                        }else{
                            alert(json_info.msg);
                        }
                    }
                })
                return false;//阻止表单跳转,如果需要表单跳转，去掉即可
            })

        });


    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>