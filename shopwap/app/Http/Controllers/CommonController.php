<?php
namespace App\Http\Controllers;

use App\Libs\alisms\SignatureHelper;

use Illuminate\Http\Request;

class CommonController extends Controller{

    /**
     * 防止非法登录
     * @return array|mixed
     */
    protected function checkUserLogin()
    {
        //防止非法登录
        if (!session('?user_info')) {
           return redirect('/login');

        } else {
            return session('user_info');
        }
    }




        #失败返回的提示
    protected function fail( $msg = '' ,int $status = 1 ,array $data = []){
        return response()->json([
            'status'=>$status,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }



    #成功返回的提示
    protected function success( array $data=[] , $msg="success" ,int $status=1000 ){
        return response()->json([
            'status'=>$status,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }

    /**
     * 生成短信验证码
     */
    protected  function createCode(){
        $str="01234567893126578940";
        return substr(str_shuffle($str),rand(0,14),4);
    }

    /** 短信发送
     * @param $number  收件人的手机号
     * @param $code    验证码
     * @return bool|stdClass
     */
   protected  function sms($tel,$code){
        /**
         * 发送短信
         */

        $params = array ();

        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = config('alisms.KEY');
        $accessKeySecret = config('alisms.SECRETKEY');
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $tel;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "layui";  //添雯的

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_144853128";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "code" => $code,
            //"product" => "阿里通信"
        );

        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper =new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))

        );
       return $content;


       ini_set("display_errors", "on"); // 显示错误提示，仅用于测试时排查问题
       // error_reporting(E_ALL); // 显示所有错误提示，仅用于测试时排查问题
       set_time_limit(0); // 防止脚本超时，仅用于测试使用，生产环境请按实际情况设置
       header("Content-Type: text/plain; charset=utf-8"); // 输出为utf-8的文本格式，仅用于测试

       // 验证发送短信(SendSms)接口
       print_r(sendSms());

    }


    /**
     * @param $goodsInfo
     * @param $buy_number
     * @param $old_buy_number
     * @param int $show_error
     * @return bool
     * 检查库存   库存出不来
     */
    public function checkGoodsStock($goodsInfo,$buy_number,$old_buy_number){
        #单独购买不能超过库存
        if($buy_number>$goodsInfo['goods_stock']){
            return $this->fail(
                '商品'.$goodsInfo['goods_name']. '最多只能购买'.$goodsInfo['goods_stock'].'件'
            );
        }
        #累计购买不能超过库存
        if( ($old_buy_number+$buy_number) > $goodsInfo['goods_stock'] ){
            $can_buy_number = $goodsInfo['goods_stock'] - $old_buy_number;
            if($can_buy_number>0){
                return $this->fail(
                    '商品'.$goodsInfo['goods_name'].
                    '最多只能购买'.$goodsInfo['goods_stock'].'件,您已经购买了'.$old_buy_number.'件'.
                    '还可以购买'.( $goodsInfo['goods_stock']-$old_buy_number ).'件'
                );
            }else{
                return  $this->fail(
                    '商品'.$goodsInfo['goods_name'].
                    '最多只能购买'.$goodsInfo['goods_stock'].
                    '件,您已经购买了'.$goodsInfo['goods_stock'].'不能继续购买了'
                );
            }
        }
    }



}