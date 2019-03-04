<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;

use App\Models\User as userModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class AccountController
 * @package App\Http\Controllers\Index
 * @data 2018-12-7
 * @author Geshanshan
 */
class AccountController extends CommonController{
    #登录
    public function login( Request $request ){

        #判断请求方式
        if( $request -> isMethod('post') ){
            #接用户名的值
            $user_name = $request->post( 'user_name' ,'');

            if( $user_name == '' ){
               return  $this->fail('请输入登录用户名');
            }
            #接密码的值
            $user_pwd = $request->post( 'user_pwd' ,'');
            if( $user_pwd == ''){
               return  $this->fail('密码必填');
            }

            $time=time();
            $user_obj=DB::table('shop_user')
                    ->where('user_email',$user_name)
                    ->orWhere('user_tel',$user_name)
                    ->first();
            $user_info='';
            if( $user_obj ){
                //$user_info = $user_obj -> toArray();//不行
                $user_info =  json_decode(json_encode($user_obj), true);
            }
            //dump($user_info);die;
            $last_error_time=$user_info['last_error_time'];//dump($last_error_time);die;
            $error_num=$user_info['error_num'];
            if(!empty($user_info)){
                if(substr_count($user_name,'@')){
                    $where=['user_email'=>$user_name];
                }else{
                    $where=['user_tel'=>$user_name];
                }

                //输入的密码==$userInfo['密码'];
                if(md5($user_pwd)==$user_info['user_pwd']){
                    //错误次数>=5并且时间在一小时内  不允许登录
                    if($error_num>=5&&$time-$last_error_time<3600){
                        $open_time=60-(ceil($time-$last_error_time)/60);
                      return $this->fail('当前账号已锁定,'.$open_time.'分钟之后可以登录');
                    }
                    //次数清0  时间清空
                    $updateInfo=['error_num'=>0,'last_error_time'=>null];

                    $res=DB::table('shop_user')
                            ->where($where)
                            ->update($updateInfo);

                    #登录的话  存session
                    #存session
                    $userSession=  $request -> session() -> put( 'user_info' , $user_info  );
                   //dd($userSession);die;
                    return $this->success();

                }else{
                    //距离上次错误时间超过一小时 次数改为1  时间为当前时间
                    if($time-$last_error_time>3600){
                        $updateInfo=['error_num'=>1,'last_error_time'=>$time];
                        $res=DB::table('shop_user')
                                ->where($where)
                                ->update($updateInfo);
                        return $this->fail('您还可以输入4次');
                    }else{
                        //如果错误次数>=5次 提示已锁定
                        if($error_num>=5){
                            return $this->fail('账号已锁定,请1小时之后重新登录');
                        }else{
                            //次数累计
                            $error_num++;
                            $updateInfo=['error_num'=>$error_num,'last_error_time'=>$time];
                            $res=DB::table('shop_user')
                                    ->where($where)
                                    ->update($updateInfo);
                            $num=5-$error_num;
                            return $this->fail('您还可以输入'.$num.'次');
                        }
                    }
                }

            }else{
                return  $this->fail('账号或密码不存在 请先注册!');
            }
    }else{
//            $session=$request -> session() -> get( 'user_info' );
//            return view('/regi')->with('session',$session);
            #判断是否登录  登录就直接跳转到首页   购物车页面
           if( !empty($request -> session() -> get( 'user_info' ) ) ){
              return redirect( '/cart' );
               //return $this->success();
           };

        }
        return view('index.account.login');
    }




}