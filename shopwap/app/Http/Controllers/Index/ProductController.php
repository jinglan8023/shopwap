<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Models\Goods;
use Illuminate\Support\Facades\DB;
use App\Models\GoodsSku;
use App\Models\GoodsSaleAttr;
use App\Models\Car;
class ProductController extends CommonController
{

    #商品列表
    public function goodsList(Request $request)
    {
        #根据分类ID  查询 商品  并展示
        if ($request->isMethod('get')) {
            $cate_id = $request->get('cate_id', '');

            $goods_info = DB::table('shop_goods')
                ->where('cate_id', $cate_id)
                ->get();
            return view('index.product.productList')->with('goods_info', $goods_info);
        }
    }

    #从首页直接进入详情页
    public function detail(Request $request){

        if ($request->isMethod('get')) {
            $goods_id = $request->get('goods_id', '');
            #根据商品id 查询货品表
            //从首页进详情页
            $goods_sku_info = DB::table('shop_goods')
                ->join('shop_goods_sku', 'shop_goods.goods_id', '=', 'shop_goods_sku.goods_id')
                ->where('shop_goods.goods_id', $goods_id)
                ->get();
            //dd($goods_sku_info);die;
            if (empty($goods_sku_info)) {
                return $this->fail('货品不存在');
            }
        }

        # 查询的货品对应的商品的属性
       // $this->getAttr($goods_id);
        $user_id=$request->session()->get("user_info.user_id");
        $where=[
            'user_id'=>$user_id,
        ];
        $info=car::where($where) ->get()->toArray();
        $buy_numberAarray=array_column($info,'buy_number');
        $buy_number_total=array_sum($buy_numberAarray);
        return view('index.product.productDetail', ['goods_sku_info' => $goods_sku_info,'buy_number_total'=>$buy_number_total]);
    }

    #获取商品属性
    # 查询商品对应的货品的销售属性  基本属性
    public function getAttr($goods_id){
        $where=[
            'shop_goods_sale_attr.goods_id'=>$goods_id,
            'shop_goods_sale_attr.status'=>1
        ];
        $info = DB::table('shop_goods_sale_attr')
            ->join('shop_sale_attr_value','shop_goods_sale_attr.sale_value_id=shop_sale_attr_value.sale_value_id')
            ->join('shop_sale_attr','shop_sale_attr.sale_id=shop_sale_attr_value.sale_attr_id')
            ->where($where)
            ->get();
        //var_dump($info);exit;
        if(!empty($info)){
            $attr=[];
            foreach($info as $key=>$value){
                $attr[$value['sale_attr_id']]['sale_attr_id']=$value['sale_attr_id'];
                $attr[$value['sale_attr_id']]['sale_attr_name']=$value['attr_name'];
                $attr[$value['sale_attr_id']]['son'][$value['sale_value_id']]=$value['attr_value'];
            }
        }

        #取出商品对应的sku的id  根据ID去查对应的属性值
        //dump($goodsInfo['sku_attr']);die;
        $goodsInfo = DB::table('shop_goods')
            ->join('shop_goods_sku', 'shop_goods.goods_id', '=', 'shop_goods_sku.goods_id')
            ->where('shop_goods.goods_id', $goods_id)
            ->get();
        $sale_where=[
            'id'=>['in',$goodsInfo['sku_attr']],
        ];
        $obj= DB::table('shop_sale_attr')->where($sale_where)->select('sale_value_id');
        $check_sale_value=collection($obj)->toArray();

        $check=[];
        foreach($check_sale_value as $key=>$value){
            $check[]=$value['sale_value_id'];
        }


        #取出商品对应的基本属性
        $basic_where=[
            'goods_id'=>$sku_goods_id
        ];
        $basic_list=DB::table('shop_goods_basic_attr gba')
            ->where($basic_where)
            ->join('shop_basic_attr ba','ba.basic_id=gba.basic_attr_id','left')
            ->get();

        #取出货品对应的属性
        // dump($goodsInfo['sku_attr']);exit;
        $allInfo=[];
        return $allInfo=[$attr,$check,$basic_list];

    }

        #从分类下的商品进入详情页
    public function  goodsDetail( Request $request ){

        //从分类下的商品进详情页
        if( $request->isMethod('get') ){
            $cate_id = $request->get('cate_id', '');
            $goods_id = $request->get('goods_id', '');
            $where = [
                'shop_goods_sku.goods_id' => $goods_id,
                'shop_goods.cate_id' => $cate_id
            ];
            $goods_sku_info = DB::table('shop_goods')
                ->join('shop_goods_sku', 'shop_goods.goods_id', '=', 'shop_goods_sku.goods_id')
                ->where($where)
                ->get();
            if (empty($goods_sku_info)) {
                return $this->fail('货品不存在');
            }
        }
        
        //$this->getAttr($goods_id,$cate_id);
        return view('index.product.CateProductDetail', ['goods_sku_info' => $goods_sku_info]);

    }


}