<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table='shop_address';
    protected $primaryKey='address_id';
    public $timestamps=false;


    /**查询user_id相同的数据*/
    public function getAddressInfo($where){
        $addressInfo=collection(model('Address')->where($where)->select());
        foreach($addressInfo as $k=>$v){
            //※△查找user_id相同的情况下的好几个地址的省  获取某个字段的列名用column和value  field
            //省※△将address表里的省市区数字id  通过给数组重新赋值
            $addressInfo[$k]['province']=model('Pcd')->where(['id'=>$v['province']])->value('region_name');
            //市※△查找user_id相同的情况下的好几个地址的市
            $addressInfo[$k]['city']=model('Pcd')->where(['id'=>$v['city']])->value('region_name');
            //区
            $addressInfo[$k]['district']=model('Pcd')->where(['id'=>$v['district']])->value('region_name');
        }
        return $addressInfo;
    }
}
