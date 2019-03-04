<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User as userModel;
use App\Models\UserCode as codeModel;
/**
 * 注册
 * Class RegisterController
 * @package App\Http\Controllers\Index
 * data:2019-02-20
 * Author:GeShanshan
 */
class RegisterController extends CommonController{
    /**
     * 注册视图页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function register( Request $request ){
        return view('index.register.register');
    }


    /**
     * 点击下一步 ajax请求   ajax 接收
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function receive( Request $request ){
            #接值  全接
            $tel=$request->input('tel','');
            $_token=$request->input('_token','');


//            //处理数据
//            $tel=intval($tel);
//            trim($data['pwd']);
//            trim ($data['conpwd']);

            //php验证   密码一致性
//            if($data['pwd'] != $data['conpwd']){
//                return $this->fail('两次密码不一致');
//            }

            #在shop_user表里查询是否有此电话号码
            $user_obj=userModel::where('user_tel',$tel)->first();
            if($user_obj==''){
                return $this->success();
            }else{
                return $this->fail('账号已存在,注册过了');
            }
    }

    /**
     * 发送验证码   填写验证码  视图页面
     * @param Request $request
     * @return $this
     */
    public function receiveCode( Request $request ){
        //ajax 提交后的location。href  路径带的参数
        $tel = $request -> post( 'tel' ,'');
        $pwd=$request -> post('pwd','');
        return view('index.account.receiveCode',['tel'=>$tel,'pwd'=>$pwd]);
    }


    /**
     * 手机发送短信
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function send( Request $request ){
        $_token = $request -> post( '_token' ,'');
        $tel = $request -> post( 'tel' ,'');

        //随机生成验证码
        $code=$this->createCode();
        //return $code;die;

        //调CommonController里的sms
        $res=$this -> sms ($tel,$code);

        if($res){
            //验证码发送成功  存数据库
            $codeInfo=[
                'tel'=>$tel,
                'user_code'=>$code,
                'sms_type'=>1,
                'timeout'=>time()+300,
                'ctime'=>time(),
                'status'=>1
            ];
            $codeResult=codeModel::insert($codeInfo);
            return $this -> success();
        }else{
            return $this->fail('验证码发送失败');
        }




    }

    /**
     * 验证码发送成功后点击确认 存数据库   防止短信盗刷
     */
    public function takeCode(Request $request){

        #接值
        //$data=$request->input();
        $_token = $request -> post( '_token' ,'');
        $tel = $request -> post( 'tel' ,'');
        $code = $request -> post( 'code' );
        $pwd = $request ->post('pwd','');



        //验证验证码是否正确  从数据库取数据
        $where=[
            'tel'=>$tel,
            'user_code'=>$code,
            'status'=>1
        ];
        $codeData=codeModel::where($where)->where('timeout','>',time())->first();
        /*if(empty($codeData)){
            return $this->fail('验证码不存在');
        }*/
        if($code==''){
            return $this-> fail('验证码必填');
        }else if($code!=$codeData['user_code']){
            return $this ->  fail('验证码有误');
        }else if(time() - $codeData['timeout']>300){
            //当前时间 - 过期时间
            return $this-> fail('验证码失效,5分钟n内有效,请重新获取');
        }


        $info=[
            'user_tel'=>$tel,
            'user_pwd'=>md5($pwd),
            'user_code'=>$code,
        ];
            $result=userModel::insert($info);

            if($result){
                codeModel::where('tel',$tel)->update(['status'=>2]);// 存了多条 都是在有效时间内  验证码 不同  就根据状态判断  2 的话就是第一次发的状态是要用2的
                return $this -> success();
            }else{
                return $this->fail('注册失败');
            }



    }



}