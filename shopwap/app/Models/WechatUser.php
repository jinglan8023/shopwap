<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WechatUser extends Model
{
    //
    protected $table="shop_wechat_user";
    protected $primaryKey="user_id";
    public $timestamps=false;
}