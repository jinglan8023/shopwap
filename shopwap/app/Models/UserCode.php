<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserCode extends Model{
    protected $table='shop_user_code';

    protected $primaryKey="user_id";

    public $timestamps=false;



}
