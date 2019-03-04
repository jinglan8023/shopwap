<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Storage;
class SliderController extends CommonController{
    #考试 视图展示
    public function slider(){
        return view('home.slider.sliderAdd');
    }

    #轮播图添加
    public function sliderAdd( Request $request ){

        #判断请求合法
        if ($request->isMethod('post')) {

            $slider_info=$request->post();
            unset($slider_info['_token']);
            unset($slider_info['file']);

            if( $slider_info['slider_title'] == '' ){
                return  $this->fail('轮播图标题必填');
            }
            if( $slider_info['slider_link'] == '' ){
                return  $this->fail('轮播图链接必填');
            }
            if( $slider_info['slider_score'] == '' ){
                return  $this->fail('轮播图排序必填');
            }
            $slider_info['slider_img'] = str_replace(config('IMG_PATH'), '%__IMG__%', $slider_info['slider_img']);
            //dump($slider_info);die;
            $slider_model=new Slider();
            $res=$slider_model->insertGetId($slider_info);
            //dump($res);die;
            if($res){
                return $this->success();
            }
        }

    }


    //文件上传
    function sliderimgAdd(Request $request){
        if($request->isMethod('post')){
            #接收图片
            $file = request()->file('file');
            $url_path = './uploads/cover';
            $rule = ['jpg', 'png', 'gif'];
            if ($file->isValid()) {
                //获取文件的扩展名
                $clientName = $file->getClientOriginalName();

                $tmpName = $file->getFileName();
                //获取文件的绝对路径
                $realPath = $file->getRealPath();
                $entension = $file->getClientOriginalExtension();
                if (!in_array($entension, $rule)) {
                    return '图片格式为jpg,png,jpeg,gif';
                }
                $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
                $path = $file->move($url_path, $newName);
                $namePath = $url_path . '/' . $newName;
                $res = ["code"=> 1,"font"=> "上传成功",'src'=>$namePath];
                return json_encode($res);
            }
        }

    }




}
