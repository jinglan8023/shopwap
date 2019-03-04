<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    protected $table='shop_category';
    protected $primaryKey='cate_id';
    public $timestamps=false;
}
