

         var layer;
        layui.use(['layer'],function(){
            layer = layui.layer;
        });
        //layui.use(['form',layer],function(){
        //
        //})
        function alert( msg ){
            layer.msg( msg );
            return false;
        }
