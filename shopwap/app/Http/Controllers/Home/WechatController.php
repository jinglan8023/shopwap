<?php
namespace App\Http\Controller\Home;
use App\Http\Controllers\Controller;
use App\Models\WechatUser;
class WechatController extends Controller{
    #视图展示
    public function userAdd(){
        return view('home.wechat.userAdd');
    }

}
