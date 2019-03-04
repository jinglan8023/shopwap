<?php
#  想进后台首页  先进登录页面
Route::any('/login','LoginController@login');
#后台首页
Route::any('/index','IndexController@index');
#登录
//Route::any('/login','LoginController@login');

#视图展示
Route::any('/slider','SliderController@slider');
#轮播图添加
Route::any('/sliderAdd','SliderController@sliderAdd');

#接收图片
Route::any('/img','SliderController@sliderimgAdd');

#微信用户添加
Route::any('/userAdd','WechatController@userAdd');

//后台验证码图片
Route::any('captcha-test', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = \Illuminate\Support\Facades\Validator::make(\Illuminate\Support\Facades\Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Success :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

