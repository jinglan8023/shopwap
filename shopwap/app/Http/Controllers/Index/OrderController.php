<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\OrderAddress;

class OrderController extends CommonController{
    #首页
    public function orderFirst(Request $request){
        //判断是否登录
        $user_id=$request->session()->get("user_info.user_id");
        if(! $user_id){
            return $this->fail('请先登录');
        }
        $where=[
            'user_id'=>$user_id,
            'shop_car.status'=>1  //1 正常  2  删除   3 收藏
        ];
        //购物车数据
        $carInfo=car::where($where)
            ->join('shop_goods','shop_car.goods_id','=','shop_goods.goods_id')
            ->get();
        //根据user_id  查询地址表
        $address_where=[
            'user_id'=>$user_id,
            'address_default'=>1
        ];
            $addressData=address::where($address_where)->first();
        //print_r($addressData);die;

//            $province=pcd::where('id','=', $addressData['province'])->get(['region_name']);
//
//            $city=pcd::where('id','=', $addressData['city'])->get(['region_name']);
//            $district=pcd::where('id','=', $addressData['district'])->get(['region_name']);

            $addressInfo=[
                'address_man'=>$addressData['address_man'],
                'address_tel'=>$addressData['address_tel'],
                'address_detail'=>$addressData['address_detail']
            ];




        return view('index.order.pay_money',['addressInfo'=>$addressInfo,'carInfo'=>$carInfo]);
    }

    //点击支付   入订单表  订单详情表  修改购物车表
    public function order(Request $request){
        $user_id=$request->session()->get("user_info.user_id");
        $goods_id=$request->input('goods_id');
        $g_id=explode(',',$goods_id);

        $address_name=$request->input('address_name');
        $address_tel=$request->input('address_tel');
        $address_detail=$request->input('address_detail');

        $where=[
            'user_id'=>$user_id,
            'shop_car.status'=>1  //1 正常  2  删除   3 收藏
        ];
        $carInfo=car::where($where)
            ->join('shop_goods','shop_car.goods_id','=','shop_goods.goods_id')
            ->get();

        //验证库存
        $stock=[];
        $goodsNum=car::where('user_id','=',$user_id)->whereIn('goods_id',$g_id)->select('goods_id','buy_number')->get();
        //var_dump( $goodsNum);die;


       $bol=true;
        foreach($stock as $key=>$val){
            $info=car::where('goods_id','=',$key)->get();
            if(!count($info)){
                $bol=false;
            }
        }
        //var_dump($info);die;
        if(!$bol){
            return $this->fail('库存为空');
        }







        //订单表添加
        # 开启事务
        DB::beginTransaction();
        try{
            //订单表入库
            //生成订单号
            $order_no=date('YmdHis',time()).rand(1000,9999);
            $sql="select sum(goods_selfprice) as total from shop_goods where goods_id in($goods_id)";
            $info=DB::select($sql);
            $order_amount=$info[0]->total;
            $arr=[
                'order_no'=>$order_no,
                'user_id'=>$user_id,
                'order_amount'=>$order_amount,
                'order_paytype'=>1,
                'pay_status'=>2,
                //'pay_way'=>2,
                'order_status'=>2,
                'ctime'=>time()
            ];
            $order_id=order::insertGetId($arr);

            if(!$order_id){
                throw new \Exception('订单表写入失败,请重试!');
            }
            // 删除购物车数据 修改购物车里的状态
            $save['status'] = 2;
            $save['utime'] = time();

            $res=car::where('user_id','=',$user_id)->whereIn( 'goods_id',$g_id)->update($save);
            if(!$res){
                throw new \Exception('购物车数据删除失败');
            }
            //订单详情表添加入库
            $order_detail=[];
            //dump($carInfo);die;
            foreach($carInfo as $k=>$v){
                $order_detail[$k]['order_id']=$order_id;
                $order_detail[$k]['user_id']=$user_id;
                $order_detail[$k]['goods_id']=$v['goods_id'];
                $order_detail[$k]['buy_number']=$v['buy_number'];
                $order_detail[$k]['goods_name']=$v['goods_name'];
                $order_detail[$k]['goods_img']=$v['goods_img'];
                $order_detail[$k]['status']=1;
                $order_detail[$k]['ctime']=time();
            }

            $number=orderDetail::insert($order_detail);//dump($number);die;
            if($number < 1 ){
                throw new \Exception('详情表写入失败,请重试!');
            }


            //goods  表改库存、  改不了


//            foreach($goodsNum as $k=>$v){
//                $ggg_id= $v->goods_id;
//                $buy_number=$v->buy_number;
//                $stock[$ggg_id]=$buy_number;
//            }
//
//            $goods_stock=goods::where('goods_id','=',$ggg_id)->select('goods_stock')->get();
//
//
//            foreach($carInfo as $keys=>$vals) {
//                $goods_where = [
//                    'goods_id' => $vals['goods_id'],
//                    'status' => 4
//                ];
//                $goods_save = [
//                    'goods_stock' =>  $goods_stock - $buy_number,
//                    'utime'=>time(),
//                ];
//                $obj = goods::where($goods_where)->update($goods_save);
//                if (!$obj) {
//                    throw new \Exception('商品库存修改失败');
//                }
//            }





            //订单地址表添加入库
            $orderAddress=[
                'order_id'=>$order_id,
                'user_id'=>$user_id,
                'receive_name'=>$address_name,
                'receive_phone'=>$address_tel,
                'address_detail'=>$address_detail,
                'post_code'=>000000,
                'status'=>1,
                'ctime'=>time()
            ];
            $orderAddressRes=orderAddress::insert($orderAddress);
            if($orderAddressRes < 1 ){
                throw new \Exception('订单地址表写入失败,请重试!');
            }

            #提交事务
            DB::commit();
            #返回成功
            $this->success(['order_no'=>$order_no]);
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
            //$this->fail($e->getMessage());
        }


    }


    #潮购记录  查询订单详情表
    public function orderDetail(Request $request){
        $user_id=$request->session()->get("user_info.user_id");
        $orderInfo=order::where('shop_order.user_id','=',$user_id)
            ->join('shop_order_detail','shop_order.order_id','=','shop_order_detail.order_id')
            ->get();
        //var_dump($orderInfo);die;
        return view('index.member.buyrecord')->with('orderInfo',$orderInfo);
    }

    #可以滑动的潮购记录
    public function orderAll(Request $request){
        $user_id=$request->session()->get("user_info.user_id");
        $orderInfo=order::where('shop_order.user_id','=',$user_id)
            ->join('shop_order_detail','shop_order.order_id','=','shop_order_detail.order_id')
            ->get();
        return view('index.member.userprofile')->with('orderInfo',$orderInfo);
    }



}