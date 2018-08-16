<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
    //
    public function index(){
        return view('phone.index' , ['name'=>'首页']);
    }

    public function shopcar(){
        return view('phone.shopcar' , ['title'=>'购物车']);
    }

    public function self(){
        $username = Session::get('username');
        if (empty($username)){
            $username = "未登录";
        }
        return view('phone.self' , ['title'=>'个人中心' , 'username'=>$username]);
    }

    public function login(){
        return view('phone.login' , ['title'=>'登录']);
    }

    public function login_do(){
        //接收到表单提交的username和password
        $username = Input::post('username');
        $password = Input::post('password');
        //根据加密
        $token = md5($username.$password).rand('10000000' , '99999999');
        if (empty($username)){
            return ['msg'=>'用户名不能为空' , 'code'=>'0'];
        }
        if (empty($password)){
            return ['msg'=>'密码不能为空' , 'code'=>'0'];
        }
        $password = md5($password);
        $user_info = DB::table('user')->where(['username'=>$username , 'password'=>$password])->first();
//        dd($user_info);die;
        if (!empty($user_info)){
            $data = [
                'token' =>  $token,
                'login_status'  =>  1,
            ];
            $result = DB::table('user')->where('username' , $username)->update($data);
            if ($result){
                Session::put('username' , $username);
                Session::put('token' , $token);
                return ['code'=>1 , 'msg'=>'登录成功'];
            } else {
                return ['code'=>2 , 'msg'=>"登录失败"];
            }
        } else {
            return ['code'=>0 , 'msg'=>'用户信息不存在'];
        }
    }

    public function reset_password(){
        $username = Session::get('username');
        if (!empty($username)){
            $user_info = DB::table('user')->where('username' , $username)->get()->first();
            foreach ($user_info as $user){
                $data['id'] = $user->id;
            }
        }
        return view('phone.reset_password' , ['title'=>'重置密码' , 'data'=>$data]);
    }

    public function reset_do(){
//        dd($data);die;
        $uid = Input::post('uid');
        $data['password'] = md5(Input::post('password'));
        $username = Session::get('username');
        $result = DB::table('user')->where(['id'=>$uid , 'username'=>$username])->update($data);

        if ($result){
            return ['msg'=>'修改成功' , 'code'=>1];
        } else {
            return ['msg'=>'修改失败' , 'code'=>2];
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/phone/index');
    }
}
