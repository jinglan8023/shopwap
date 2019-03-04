<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Cate;
use App\Models\Brand;
use App\Models\Goods;
use App\Models\GoodsSaleAttr;
class CategoryController extends Controller{
    /**
     * 获取前台首页分类信息 无限极分类
     */
    public  function getIndexCateInfo($cateInfo,$pid=0){
        //$data   千万不写static
         $data=[];
        foreach($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                $son=self::getIndexCateInfo($cateInfo,$v['cate_id']);
                $v['son']=$son;
                $data[]=$v;
            }
        }
        return $data;
    }



    #视图展示页面
    public function category(){
        #查询商品分类信息
        $cate_model=new Cate();
        //dd($cate_model);die;

        $cateInfo=$cate_model->where('cate_show','1')->get();
        //dd($cateInfo);die;
        $data=CategoryController::getIndexCateInfo($cateInfo);
        //dump($data);die;

        #查询品牌
        $brand_model= new Brand();
        $brand_info=$brand_model->select('brand_id', 'brand_name')->get();


        #查询最新
        $newGoods=Goods::where('goods_new',1)->get();

        #查询分类抛到视图页面 用with
        return view('index.category.category',['data'=>$data,'brand'=>$brand_info,'new'=>$newGoods]);

    }




    #最新揭晓
    public function newKnow(){
        #查询商品分类信息
        $cate_model=new Cate();
        //dd($cate_model);die;

        $cateInfo=$cate_model->where('cate_show','1')->get();
        //dd($cateInfo);die;
        $data=CategoryController::getIndexCateInfo($cateInfo);
        //dump($data);die;
        return view('index.newknow.newknow',['data'=>$data]);

    }




}