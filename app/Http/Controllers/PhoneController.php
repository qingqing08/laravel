<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneController extends Controller{
    //
    public function index(){
        return view('phone.index' , ['name'=>'首页']);
    }

    public function shopcar(){
        return view('phone.shopcar' , ['title'=>'购物车']);
    }

    public function self(){
        return view('phone.self' , ['title'=>'个人中心' , 'action_name'=>'self']);
    }

    public function login(){
        return view('phone.login' , ['title'=>'登录']);
    }
}
