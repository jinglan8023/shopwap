<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class AccountController
 * @package App\Http\Controllers\Index
 * @data 2018-12-7
 * @author Geshanshan
 */
class AddressController extends CommonController{
    #地址添加
    public function addressAdd(Request $request){
        $all_val=$request->input();
        array_shift($all_val);

       if($all_val['address_default'] == true){
           $all_val['address_default']=1;
       }else{
           $all_val['address_default']=0;
        }
        $user_id=$request->session()->get("user_info.user_id");
        $all_val['user_id']= $user_id;
        $all_val['status']= 1;
        $all_val['ctime']= time();
        $address_id = address::insertGetId($all_val);
        if($address_id){
          return  $this->success();
        }else{
           return $this->fail('保存失败');
        }

    }

    //地址展示
    public function addressList(Request $request){
        $user_id=$request->session()->get("user_info.user_id");
        $where=[
            'user_id'=>$user_id,
            'status'=>1
        ];
        $user_address=address::where($where)->get();

        return view('index.Address.address')->with('user_address',$user_address);
    }

    //地址删除  修改其状态
    public function addressDel(Request $request){
        $address_id=$request->input('address_id');
        $user_id=$request->session()->get("user_info.user_id");
        $where=[
            'address_id'=>$address_id
        ];
        $res=address::where($where)->update(['status'=>2]);
        if($res){
            return  $this->success();
        }else{
            return $this->fail('删除失败');
        }
    }



    //地址修改
    public function addressUpdate(Request $request){
        $address_id=$request->input('address_id');
        $user_id=$request->session()->get("user_info.user_id");
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id
        ];
        $user_address=address::where($where)->first();

       return view('index.Address.addressUpdate')->with('user_address',$user_address);
    }


        //收货地址执行修改
        public function addressUpdateDo(Request $request){
            $user_id=$request->session()->get("user_info.user_id");

            $all_val=$request->input();
            array_shift($all_val);

            if($all_val['address_default'] == true){
                //如果修改的是 是否改为默认地址
                //是的话
                $all_val['address_default']=1;
                #同时根据改另一个默认的
                //根据user-id 查找 address_default ==1的
                $address_default=address::where('user_id','=',$user_id)->first();
                address::where('user_id',$address_default['user_id'])->update(['address_default'=>0]);
            }else{
                $all_val['address_default']=0;
            }
            $all_val['user_id']= $user_id;
            $all_val['status']= 1;
            $all_val['utime']= time();
            $where=[
                'address_id'=>$all_val['address_id'],
            ];

            $address_id = address::where($where)->update($all_val);
            if($address_id){
                return  $this->success();
            }else{
                return $this->fail('修改失败');
            }
        }















}