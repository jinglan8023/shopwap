<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Goods;
use App\Models\Car;
/**
 * Class CartController
 * @package App\Http\Controllers\Index
 * @data 2018-12-11
 * @author Geshanshan
 */
class CartController extends CommonController{

    /**
     * 没登录  请先登录
     * 登陆的情况下  应该不能收藏不能加入购物车   购物车数据存 数据库
     * 通过详情跳到购物车
     */
    public function shopCart( Request $request){
        #判断是否登录
            if(session('user_info')){
                #是登录状态
                return $this->success();
            }else{
                return $this->fail('请先登录');
            }

    }


    /**
     * @param Request $request
     * @return $this
     * 查询 当前用户之前购物车就有的数据
     */
    public  function oldCar(Request $request){
        $user_id=$request->session()->get("user_info.user_id");

        #判断该用户的购物车里之前是否有商品
        #有就展示出来
        $where=[
            'user_id'=>$user_id,
            'shop_car.status'=>1  //1 正常  2  删除   3 收藏
        ];
        $carInfo=car::where($where)
            ->join('shop_goods','shop_car.goods_id','=','shop_goods.goods_id')
            ->get();

        return view('index.shopcart.shopcart')->with('carInfo',$carInfo);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 点击方块的购物车    执行添加
     */
    public function addCar(Request $request){
        $user_id=$request->session()->get("user_info.user_id");

        //通过ajax 接值   接商品id
        $goods_id=request()->input('goods_id');

        #接收购买的数量
        $buy_number=request()->input('buy_number');

        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id
        ];
        if(empty($goods_id)){
            $this->fail('要购买的商品没有找到!');//没有接收到
        }

        #查询商品是否存在
        $where2=[
            'goods_id'=>$goods_id,
            'goods_up'=>1
        ];
        $goodsInfo=goods::where($where2)->first();
        if( empty($goodsInfo) ){
            $this->fail('要购买的商品没有找到!');//商品id  恶意数据
        }
        if( empty($buy_number) ){
            $this->fail('请添加购买的数量!');
        }
        if(!empty($goods_id)&&!empty($buy_number)){
            #查询该用户购物车内是否有该商品
            $carInfo=car::where($where)->first();
            if($carInfo){
                //修改购买数量前  先判断库存
                $this->checkGoodsStock( $goodsInfo,$buy_number,$carInfo['buy_number']);
                #有的话  修改购买数量
                $save=[];
                $save['buy_number']=$carInfo['buy_number']+$buy_number;
                $save['utime']=time();

                $res=car::where($where)->update($save);
            }else{
                //添加前先判断  库存
                $this->checkGoodsStock( $goodsInfo,$buy_number,$carInfo['buy_number']);
                #没有的话  添加
                $insert=[
                    'user_id'=>$user_id,
                    'goods_id'=>$goods_id,
                    'buy_number'=>$buy_number,
                    'status'=>1,
                     'ctime'=>time()
                ];
                $res=car::insert($insert);
            }
            if($res){
               return $this->success();
            }else{
                return $this->fail('添加失败');
            }
        }
    }



    #点击减  ajax 修改   #点击+  ajax 修改   删除
    public function ajaxUpdate(Request $request){
        $user_id=$request->session()->get("user_info.user_id");

        //通过ajax 接值   接商品id
        $goods_id=$request->input('goods_id');
        $car_id=$request->input('car_id');
        #接收购买的数量
        $buy_number=$request->input('buy_number');
        $type=$request->input('type');

            $where=[
                'car_id'=>$car_id,
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
            ];



        if( $type == 1 ){

            $save=[];
            $save['buy_number']=$buy_number;
            $save['utime']=time();

            $res=car::where($where)->update($save);
            if($res){
                return $this->success();
            }
        }else if( $type == 2 ){

            $save=[];
            $save['buy_number']=$buy_number;
            $save['utime']=time();

            $res=car::where($where)->update($save);
            if($res){
                return $this->success();
            }
        }else if( $type == 3 ){

            $save=[];
            $save['buy_number']=$buy_number;
            $save['utime']=time();

            $res=car::where($where)->update($save);
            if($res){
                return $this->success();
            }
        }else if($type == 4){
            #删除改变状态

            $save=[];
            $save['status']=2;
            $save['utime']=time();

            $res=car::where($where)->update($save);
            if($res){
                return $this->success();
            }
        }else if($type == 5){
            #批量删除改变状态

            $car_id=explode(',',$car_id);
            $goods_id=explode(',',$goods_id);


            $save['status'] = 2;
            $save['utime'] = time();

            $res=car::where('user_id','=',$user_id)->whereIn( 'goods_id',$goods_id)->update($save);

            if($res){
                return $this->success();
            }else{
                return $this->fail('删除失败');
            }
        }

    }

}
