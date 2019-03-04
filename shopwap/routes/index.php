<?php
#前台


#首页
Route::any('/index','IndexController@index');
Route::any('/v41/index.do','IndexController@index');
Route::any('/v44/index.do','IndexController@index');



#流加载  货品列表
Route::any('/productList','IndexController@productList');

#登录
Route::any('/login','AccountController@login') -> name('login');

#注册
Route::any('/regi','RegisterController@register');

#注册的下一步  ajax请求
Route::any('/receive','RegisterController@receive');

#验证码  视图页面
Route::any('/receiveCode','RegisterController@receiveCode');

#发送验证码
Route::any('/send','RegisterController@send');
#验证码手机号 从数据库取验证码数据
Route::any('/takeCode','RegisterController@takeCode');

#所有分类
Route::any('/cate','CategoryController@category');

#最新揭晓
Route::any('/v41/post/index.do','CategoryController@newknow');

#最新揭晓  单页面
Route::any('/newknow','CategoryController@newknow');

#最新揭晓
Route::any('/v41/lottery','CategoryController@newknow');
Route::any('/v44/lottery','CategoryController@newknow');



#购物车
Route::any('/v41/mycart/index.do',function(){
    return view('index.shopcart.shopcart');
});
#购物车
Route::any('/v44/mycart/index.do',function(){
    return view('index.shopcart.shopcart');
});
#购物车
Route::any('/cart','CartController@shopCart');

#user_id  购物车原有的数据
Route::any('/oldcar','CartController@oldCar');
# 点击加入购物车
Route::any('/addcar','CartController@addCar');

#点击购物车里的  +       点击购物车里的  -     走的一个方法
Route::any('/ajaxUpdate','CartController@ajaxUpdate');




#个人中心
Route::any('/v41/member/index.do',function(){
    return view('index.member.userpage');
});
//收货地址展示页面
Route::any('/member/address','AddressController@addressList');

#收货地址  点击保存  添加收货地址
Route::any('/addressAdd','AddressController@addressAdd');

#添加收货地址  添加页面
Route::any('/writeAddress',function(){
    return view('index.Address.writeAddress');
});

//收货地址删除
Route::any('/remove','AddressController@addressDel');


//收货地址修改
Route::any('/edit','AddressController@addressUpdate');
//执行修改
Route::any('/addressUpdateDo','AddressController@addressUpdateDo');


#潮购记录
Route::any('/v44/member/goodsbuylist.do','OrderController@orderDetail');

#潮购记录  可以❀划的潮购页面
Route::any('/userprofile','OrderController@orderAll');



#晒单




//所有商品分类
Route::any('/cate','CategoryController@category');


#商品列表
Route::any('/list','ProductController@goodsList');

//商品详情   从首页点击出来但是属性不出来   从分类商品点击时  报错
Route::any('/detail','ProductController@detail');
Route::any('/goodsDetail','ProductController@goodsDetail');

//手机支付  报错
Route::any('/alipay','IndexController@alipay');

#点击立即购买   进结算
Route::any('/pay','OrderController@orderFirst');

Route::any('/order','OrderController@order');

