<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Admin;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    #登录首页  视图展示
    public function login(Request $request){
        if($request->isMethod('post')){
            //接收数据
            $data=$request->post();
            //dump($data);die;
            //验证验证码是否正确
            if(!captcha_check($data['code'])){
                //验证码错误
                return ['Status'=>"Erro",'Erro'=>'验证码有误'];
            };
            //验证用户名是否跟数据库一样
            $adminModel= new Admin();

           // $where=['admin_name'=>$data['admin_name']];

            $adminObj=$adminModel->where('admin_name',$data['admin_name'])->first();
            if($adminObj){
                $adminInfo=$adminObj->toArray();
            }

            if(!empty($adminInfo)){
                //如果有数据就去验证密码
                //验证密码是否跟数据库里加密的一样
                $admin_pwd=md5(md5($data['admin_pwd']).md5($adminInfo['salt']).'shop');
                //如果密码一样就存session 加登录时间 IP
                if($admin_pwd==$adminInfo['admin_pwd']){
                    //先存session信息

                    #存了 管理员一部分信息
                    #$admin=['admin_id'=>$adminInfo['admin_id'],'admin_name'=>$adminInfo['admin_name'],'admin_type'=>$adminInfo['admin_type']];
                    #session('adminInfo',$admin);//不用序列化
                    //$str=serialize($admin);
                    //$arr=unserialize($str);print_r($arr);

                    //存session信息
                    session('adminInfo',$adminInfo);//存整条的管理员信息
                    //记住取的时候还要反序列化拿出来

                    //修改最后一次登陆的IP  登录时间
                    $arr=['last_login_time'=>time(),'last_login_ip'=>request()->ip()];

                    $updateWhere=['admin_id'=>$adminInfo['admin_id']];
                    model('Admin')->where($updateWhere)->update($arr);

                    //再返回登录成功
                    return ['Status'=>"ok",'ok'=>'登录成功ok'];

                }


            }else{
                return ['Status'=>"Erro",'Erro'=>'账号或密码有误'];
            }

        }else{

        }
        return view('home.login.login');
    }







}
