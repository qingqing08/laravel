<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\DB;

class Cms extends Controller{

    public function index(){
        return view('index' , ['name'=>'彭晴晴']);
    }
    
    public function userlist(){
        $userlist = DB::table('user')->get();
        return view('user.userlist' , ['userlist' => $userlist]);
    }

    public function useradd(){
        return view('user.useradd');
    }

    public function useradd_do(){
//        dd(input::post());die;
        $data = input::post();
        unset($data['_token']);
        $data['password'] = md5($data['password']);
        $result = DB::table('user')->insert($data);
        if ($result){
            return redirect("/userslist");
        } else {
            return redirect("/userslist");
        }
    }

    public function userdel(Request $request){
        $uid = $request->get('id');
//        dd($uid);die;
        $result = DB::table('user')->delete($uid);
        if ($result){
            return redirect("/userslist");
        } else {
            return redirect("/userslist");
        }
    }

    public function updateuser(Request $request){
        $uid = $request->get('id');
        $userinfo = DB::table('user')->where('id', $uid)->get();
        foreach ($userinfo as $value){
            $data['id'] = $value->id;
            $data['username'] = $value->username;
            $data['sex'] = $value->sex;
            $data['age'] = $value->age;
        }
//        dd($data);die;
        return view('user.usermodify' , ['data'=>$data]);
    }

    public function usermodify_do(Request $request){
        $data = $request->post();
        unset($data['_token']);
        unset($data['uid']);
        $uid = $request->post('uid');
        $result = DB::table('user')->where('id' , $uid)->update($data);
        if ($result){
            return redirect("/userslist");
        } else {
            return redirect("/userslist");
        }
    }
}
