<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $table='shop_car';
    protected $primaryKey='car_id';
    public $timestamps=false;
}
