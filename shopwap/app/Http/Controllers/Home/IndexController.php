<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){
        //echo 'this is home后台';
        return view('home.index.index');
    }

//    public function login(){
//        return view('home.login.login');
//    }

}
