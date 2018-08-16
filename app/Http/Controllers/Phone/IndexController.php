<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller{
    //
    public function index(){
        $goodslist = DB::table('goods')->where('status' , 1)->get();
        $bannerlist = DB::table('banner')->get();
        return view('phone.index' , ['name'=>'首页' , 'goodslist'=>$goodslist , 'bannerlist'=>$bannerlist]);
    }

    public function detail(){
        $id = Input::get('id');
//        echo $id;
        $info = DB::table('goods')->where('id' , $id)->first();
//        dd($info);die;
        return view('phone.detail' , ['title'=>'详情' , 'goods_info'=>$info]);
    }

    public function create_cart(){
        $username = Session::get('username');
        if (empty($username)){
            return ['msg'=>'请登录后操作' , 'code'=>0];
        }
        $goods_id = Input::post('goods_id');
        $goods_price = Input::post('goods_price');
//        echo $goods_id;
//        echo $username;
        $user_info = DB::table('user')->where('username',$username)->first();
//        dd($user_info['id']);die;
        $data = [
            'uid'   =>  $user_info->id,
            'goods_id'  =>  $goods_id,
            'goods_price'  =>  $goods_price,
        ];
        $cart_info = DB::table('cart')->where(['uid'=>$user_info->id , 'goods_id'=>$goods_id])->first();
        if (!empty($cart_info)){
            $data = [
                'num'   =>  $cart_info->num+1,
            ];
            $result = DB::table('cart')->where(['uid'=>$user_info->id , 'goods_id'=>$goods_id])->update($data);
        } else {
            $result = DB::table('cart')->insert($data);
        }


        if ($result){
            return ['msg'=>'加入购物车成功' , 'code'=>1];
        } else {
            return ['msg'=>'加入购物车失败,请检查网络' , 'code'=>2];
        }
    }
}
