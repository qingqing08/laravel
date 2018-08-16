<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller{
    //
    public function login(){
        return view('home.login' , ['title'=>'后台登陆']);
    }

    public function login_do(){
        $data = Input::post();

        if (!empty($data)) {
            return ['code'=>1 , 'msg'=>'接收数据成功'];
        } else {
            return ['code'=>2 , 'msg'=>"数据接收失败"];
        }
    }

}
