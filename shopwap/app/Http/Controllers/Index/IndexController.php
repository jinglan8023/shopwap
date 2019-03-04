<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\GoodsSku;
use App\Models\Goods;
use App\Models\slider;
class IndexController extends Controller{
    //模板布局
    public function index( Request $request){

        #查询轮播图
        $slider_model=new Slider();
        //dump($slider_model);die;
        $img_info=$slider_model->all();
        //dump($img_info);die;
        return view( 'index.index.index' ) -> with( [ 'title' => '电商首页' , 'show_footer' => 1,'imgInfo'=>$img_info] );
    }
    //首页商品(上架的)展示
    public function productList( ){

            //懒惰式加载   猜你喜欢
        $product_obj = GoodsSku::with( 'goods')
                        ->join( 'shop_goods','shop_goods_sku.goods_id','=','shop_goods.goods_id')
                        -> where( 'shop_goods_sku.status' , 4 )
                        -> paginate(3);

            $view = view( 'index.index.list' ) -> with( 'product' , $product_obj);

            $data['view_content'] = response( $view ) -> getContent();
            $data['page_count'] = $product_obj -> lastPage();
            return $data;
    }


    //手机支付 测试
    public function alipay(){
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no =time().rand(1000,9999);

        //订单名称，必填
        $subject = '订单名称';

        //付款金额，必填
        $total_amount = 0.01;

        //商品描述，可空
        $body = '测试支付';

        //超时时间
        $timeout_express="1m";

        $config=require app_path().'/Libs/alipay/config.php';


        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new \AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return ;
    }




}