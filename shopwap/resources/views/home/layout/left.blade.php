
<div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree"  lay-filter="test">

        <li class="layui-nav-item layui-nav-itemed">
            <a class="" href="javascript:;">所有商品</a>
            <dl class="layui-nav-child">
                <dd><a href="{{url('/slider')}}">商品轮播图</a></dd>
                <dd><a href="javascript:;">列表二</a></dd>
                <dd><a href="javascript:;">列表三</a></dd>
                <dd><a href="">超链接</a></dd>
            </dl>
        </li>

        <li class="layui-nav-item">
            <a href="javascript:;">微信用户管理</a>
            <dl class="layui-nav-child">
                <dd><a href="{{url('/userAdd')}}">用户添加</a></dd>
                <dd><a href="javascript:;">列表二</a></dd>
                <dd><a href="">超链接</a></dd>
            </dl>
        </li>

        <li class="layui-nav-item">
            <a href="javascript:;">解决方案</a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">列表一</a></dd>
                <dd><a href="javascript:;">列表二</a></dd>
                <dd><a href="">超链接</a></dd>
            </dl>
        </li>

    </ul>
</div>
