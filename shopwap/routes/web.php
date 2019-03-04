<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





//前台路由组
Route::group(['domain' => 'www.shopwap.com','namespace' => 'Index'], function(){

    include base_path() . '/routes/index.php';

});









//后台 路由组子域名设置为www.shopwaphome.com 命名空间为 Home
Route::group(['domain' => 'www.shopwaphome.com','namespace' => 'Home'],function (){
    include base_path() . '/routes/home.php';
});










