<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * 货品模型
 * Class GoodsModel
 * @package App\Models
 */
class GoodsSku extends Model{
    public $table='shop_goods_sku';
    public $primaryKey='sku_id';
    public $timestamp=false;

    public function goods(){
        return $this->belongsTo( 'App\Models\Goods' , 'goods_id' ,'goods_id');
    }


}

