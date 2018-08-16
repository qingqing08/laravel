<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use RSA;

class ShopcarController extends Controller{
    //
    public function shopcar(){
        $username = Session::get('username');
        if (empty($username)){
            return redirect('/login');
        }
        $user_info = DB::table('user')->where('username' , $username)->first();
//        dd($user_info);die;
        $cart_list = DB::table('cart')->where('uid' , $user_info->id)->get();
//        dd($cart_list);die;
        $price = 0;
        foreach ($cart_list as $goods){
            $goods_info = DB::table('goods')->where('id' , $goods->goods_id)->first();
            $goods->image_url = $goods_info->image_url;
            $goods->title = $goods_info->name;
            $goods->price = $goods_info->out_price*$goods->num;
            $price = $price+$goods->price;
        }
//        dd($cart_list);die;
        return view('phone.shopcar' , ['title'=>'购物车' , 'cart_list'=>$cart_list , 'price'=>$price]);
    }

    public function buy(){
        $goods_id = trim(Input::post('goods_id') , ',');
        $price = Input::post('price');
//        echo $goods_id;die;
        $order_id = date('YmdHis',time()).rand("100000","999999");
        $goods_id = explode(',' , $goods_id);
        $user_info = DB::table('user')->where('username' , Session::get('username'))->first();
        $cart_list = DB::table('cart')->where('uid' , $user_info->id)->whereIn('goods_id' ,$goods_id)->get();

        $data = [
            'order_id'  =>  $order_id,
        ];
        foreach ($cart_list as $value){
            $data['price'] = $value->goods_price;
            $data['num'] = $value->num;
            $data['g_id'] = $value->goods_id;
            $data['status'] = 0;

            $result = DB::table('order')->insert($data);
            $goodsinfo = DB::table('goods')->where('id' , $value->goods_id)->first();
            DB::table('goods')->where('id' , $value->goods_id)->update(['num'=>$goodsinfo->num-$data['num']]);
        }
        if ($result){
            DB::table('cart')->where('uid' , $user_info->id)->whereIn('goods_id' , $goods_id)->delete();
            return ['msg'=>'正在去订单页' , 'code'=>1 , 'order_id'=>$order_id];
        } else {
            return ['msg'=>'结算失败' , 'code'=>2];
        }
//        return view('phone.buy' , ['title'=>'结算']);
    }

    public function buy_view(){
        $order_id = Input::get('order_id');
        $user_info = DB::table('user')->where('username',Session::get('username'))->first();
//        dd($user_info);die;
        if (empty($user_info)){
            return redirect('/login');
        }
        $address_info = DB::table('address')->where(['u_id'=>$user_info->id , 'status' => 1])->first();

        $goods_list = DB::table('order')->where('order_id',$order_id)->get();
        $price = 0;
        foreach ($goods_list as $value){
            $goods = DB::table('goods')->where('id',$value->g_id)->first();
            $value->image_url = $goods->image_url;
            $value->title = $goods->name;
            $value->price = $value->price*$value->num;

            $price = $price+$value->price;
        }
        $info = [];
        $goods_list->toArray();
        $info['goods_list'] = $goods_list;
        $info['price'] = $price;
        $info['address_info'] = $address_info;
        $info['order_id'] = $order_id;

        $data = [
            'order_number'  =>  $order_id,
            'u_id'  =>  $user_info->id,
            'user_name' =>  $address_info->u_name,
            'user_phone'    =>  $address_info->phone,
            'province'  =>  $address_info->province,
            'city'  =>  $address_info->city,
            'county'    =>  $address_info->county,
            'address'   =>  $address_info->address,
            'time'  =>  time(),
            'status'    =>  1,
        ];

        $data['price'] = 0.01;
        $is_mobile = $this->isMobile();
//        dd($is_mobile);die;
        if ($is_mobile){
            $data['is_mobile'] = 1;
        } else {
            $data['is_mobile'] = 0;
        }
        $order_info = DB::table('ordercontent')->where('order_number' , $order_id)->first();
        if (empty($order_info)){
            $result = DB::table('ordercontent')->insert($data);
        }
//        dd($info);
        return view('phone.buy' , ['title'=>'结算' , 'info'=>$info]);
    }

    public function isMobile(){
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
        function CheckSubstrs($substrs,$text){
            foreach($substrs as $substr)
                if(false!==strpos($text,$substr)){
                    return true;
                }
            return false;
        }
        $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5',
            'Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
        $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240',
            'UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision',
            'Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

        $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
            CheckSubstrs($mobile_token_list,$useragent);

        if ($found_mobile){
            return true;
        }else{
            return false;
        }
    }

    public function up_num(){
        $obj = Input::post('obj');
        $username = Session::get('username');
        $goods_id = Input::post('goods_id');
        $userinfo = DB::table('user')->where('username',$username)->first();
        $info = DB::table('cart')->where(['uid'=>$userinfo->id , 'goods_id'=>$goods_id])->first();
        if ($obj == 'jian'){
            $num = $info->num-1;
            $data = [
                'num'   =>  $num,
            ];
        }
        if ($obj == 'jia'){
            $num = $info->num+1;
            $data = [
                'num'   =>  $num,
            ];
        }

        $result = DB::table('cart')->where(['uid'=>$userinfo->id , 'goods_id'=>$goods_id])->update($data);
        if ($result){
            return ['msg'=>'修改成功' , 'num'=>$num , 'price'=>$info->goods_price];
        } else {
            return ['msg'=>'修改失败' , 'num'=>$num , 'price'=>$info->goods_price];
        }
//        return $obj;
    }

    public function recovery(){
        $order_list = DB::table('ordercontent')->where('status',1)->get();
        foreach ($order_list as $order){
            $time = time()-$order->time;
            if ($time >= 60*30){
                $order_data = DB::table('order')->where('order_id',$order->order_number)->get();
                foreach ($order_data as $data){
                    $info = DB::table('goods')->where('id',$data->g_id)->first();
                    DB::table('goods')->where('id',$data->g_id)->update(['num'=>$info->num+$data->num]);
                }
                DB::table('order')->where('order_id',$order->order_number)->update(['status'=>2]);
                DB::table('ordercontent')->where('order_number',$order->order_number)->update(['status'=>0]);
//                echo $order->order_number;
            }
        }

    }

}
