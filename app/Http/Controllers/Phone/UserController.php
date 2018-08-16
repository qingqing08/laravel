<?php

namespace App\Http\Controllers\Phone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
//    public function
    public function shopcar(){
        return view('phone.shopcar' , ['title'=>'购物车']);
    }

    public function self(){
        $username = Session::get('username');
//        echo $username;die;
        if (empty($username)){
            $username = "未登录";
        }
        return view('phone.self' , ['title'=>'个人中心' , 'username'=>$username]);
    }
    public function register(){
        return view('phone.register' , ['title'=>'注册']);
    }

    public function register_do(){
        //接收到表单提交的username和password
        $username = Input::post('username');
        $password = Input::post('password');
        $phone = Input::post('phone');
        $code = Input::post('code');
        //根据加密
        $token = md5($username.$password).rand('10000000' , '99999999');
        if (empty($username)){
            return ['msg'=>'用户名不能为空' , 'code'=>'0'];
        }
        if (empty($password)){
            return ['msg'=>'密码不能为空' , 'code'=>'0'];
        }
        if (empty($phone)){
            return ['msg'=>'手机号不能为空' , 'code'=>'0'];
        }
        if (empty($code)){
            return ['msg'=>'验证码不能为空' , 'code'=>'0'];
        }
        if ($code != Session::get('code')){
            return ['msg'=>'验证码错误' , 'code'=>'0'];
        }

        $password = md5($password);

        $data = [
            'username'  =>  $username,
            'password'  =>  $password,
            'phone'     =>  $phone,
            'token'     =>  $token,
            'login_status'  =>  0,
        ];
//        dd($data);die;
        $user_info = DB::table('user')->where('username' , $username)->first();
        if (empty($user_info)){
            $result = DB::table('user')->insert($data);
            if ($result){
                return ['msg'=>'注册成功' , 'code'=>1];
            } else {
                return ['msg'=>'注册失败' , 'code'=>2];
            }
        } else {
            return ['msg'=>'该用户已存在' , 'code'=>0];
        }


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
        $user_info = DB::table('user')->where(['username'=>$username])->first();
//        dd($user_info);die;
        if (!empty($user_info)){
            if ($user_info->password != $password){
                return ['code'=>0 , 'msg'=>'账号密码不匹配'];
            }
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
            return ['code'=>0 , 'msg'=>'账号密码不匹配'];
        }
    }

    public function reset_password(){
        $username = Session::get('username');
        if (empty($username)){
            return redirect('login');
        }
        $user_info = DB::table('user')->where('username' , $username)->get()->first();
        $data['id'] = $user_info->id;
        return view('phone.reset_password' , ['title'=>'重置密码' , 'data'=>$data]);
    }

    public function reset_do(){
//        dd($data);die;
        $uid = Input::post('uid');
        $password = Input::post('password');
        $data['password'] = md5($password);
        $username = Session::get('username');
        if (empty($uid)){
            return ['msg'=>'用户登录失效' , 'code'=>5];
        }

        if (empty($password)){
            return ['msg'=>'请输入密码' , 'code'=>0];
        }
        $result = DB::table('user')->where(['id'=>$uid , 'username'=>$username])->update($data);

        if ($result){
            return ['msg'=>'修改成功' , 'code'=>1];
        } else {
            return ['msg'=>'修改失败' , 'code'=>2];
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }

    public function order(){
        $status = Input::get('status');
        $username = Session::get('username');
        $user_info = DB::table('user')->where('username' , $username)->first();
        if (empty($status)){
            $order_list = DB::table('ordercontent')->where('u_id' , $user_info->id)->get();
            $price = 0;
            foreach ($order_list as $order){
                $order->time = date('Y-m-d H:i:s' , $order->time);
                if ($order->status == 1){
                    $order->status = '待支付';
                    $order->status_b = '去支付';
                } else if ($order->status == 2){
                    $order->status = '待发货';
                    $order->status_b = '';
                } else if ($order->status == 3){
                    $order->status = '已发货';
                    $order->status_b = '确认收货';
                } else if ($order->status == 4){
                    $order->status = '已完成';
                    $order->status_b = '确认收货';
                } else {
                    $order->status = '交易关闭';
                    $order->status_b = '';
                }

                $order->order = DB::table('order')->where('order_id' , $order->order_number)->get();
                $price = 0;
                foreach ($order->order as $goods){
                    $info = DB::table('goods')->where('id' , $goods->g_id)->first();
                    $goods->title = $info->name;
                    $goods->image_url = $info->image_url;
                    $num = $goods->price*$goods->num;
                    $price = $price+$num;
                }
            }
//            dd($order_list);

            return view('phone.order' , ['order_list'=>$order_list , 'price'=>$price]);
        }
    }

    public function get_sms(){
        date_default_timezone_set("PRC");
        $tel = Input::post('phone');
        if (empty($tel)){
            return ['msg'=>'手机号不能为空' , 'code'=>0];
        }

        $rand = rand(100000 , 999999);
        $showapi_appid = '69664';  //替换此值,在官网的"我的应用"中找到相关值
        $showapi_secret = '007c22caa1f94c1996c5fcf637f1290f';  //替换此值,在官网的"我的应用"中找到相关值
        $paramArr = array(
            'showapi_appid'=> $showapi_appid,
            'mobile'=> "$tel",
            'content'=> "{\"name\":\"$tel\",\"code\":\"$rand\",\"minute\":\"5\"}",
            'tNum'=> "T170317002781",
            'title'=>'希芸护肤',
            'big_msg'=> ""
            //添加其他参数
        );

        $param = $this->createParam($paramArr,$showapi_secret);
        $url = 'http://route.showapi.com/28-1?'.$param;
//        echo "请求的url:".$url."\r\n";
        $result = file_get_contents($url);
//        echo "返回的json数据:\r\n";
//        print $result.'\r\n';
        $result = json_decode($result , true);
//        echo "\r\n取出showapi_res_code的值:\r\n";
        if ($result['showapi_res_body']['remark'] == "提交成功!" && $result['showapi_res_body']['successCounts'] == 1){
            $data = [
                'phone' =>  $tel,
                'code'  =>  $rand,
                'ctime' =>  time(),
            ];
            $code_info = DB::table('getcode')->where('phone' , $tel)->first();
//            $code_info = $code_info->toArray();
            if (empty($code_info)){
                $res = DB::table('getcode')->insert($data);
            } else {
                $res = DB::table('getcode')->where('phone' , $tel)->update($data);
            }

            if ($res){
                Session::put('code' , $rand);
                return ['msg'=>'短信发送成功' , 'code'=>1];
            } else {
                return ['msg'=>'短信发送失败' , 'code'=>2];
            }
        } else {
            return ['msg'=>'短信发送失败' , 'code'=>2];
        }
//        dd($result);
//        echo "\r\n";
    }

    public function createParam ($paramArr,$showapi_secret) {
        $paraStr = "";
        $signStr = "";
        ksort($paramArr);
        foreach ($paramArr as $key => $val) {
            if ($key != '' && $val != '') {
                $signStr .= $key.$val;
                $paraStr .= $key.'='.urlencode($val).'&';
            }
        }
        $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
        $sign = strtolower(md5($signStr));
        $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
//        echo "排好序的参数:".$signStr."\r\n";
        return $paraStr;
    }

    public function personal(){
        $username = Session::get('username');
//        echo $username;die;
        if (empty($username)){
            return redirect('login');
        }
        return view('phone.personal' , ['title'=>'个人中心']);
    }

    public function one(){

    }
}
