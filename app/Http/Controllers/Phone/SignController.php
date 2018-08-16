<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SignController extends Controller{
    //
    public function index(){
        $uid = Input::get('uid');
        Session::put('uid' , $uid);
        $list = DB::table('sign')->where('uid',$uid)->get();

        return view('phone.sign' , ['list'=>$list]);
    }

    public function sign(){
        $uid = Session::get('uid');
//        $date = date("Y-m-d" , time());
//        $yes_date = date("Y-m-d" , strtotime("-1 day"));
        $date = date('Y-m-d' , strtotime('+5 day'));
        $yes_date = date('Y-m-d' , strtotime("+4 day"));
//        $yes_date = date('Y-m-d' , time());
        $info = DB::table('sign')->where('uid' , $uid)->first();
        $data = [
            'sign_date'  =>  $date,
            'uid'   =>  $uid,
            'number'    =>  1,
            'day'    =>  1,
            'integral'  =>  1,
        ];
        if (empty($info)){
            $result = DB::table('sign')->insert($data);
        } else {
            if ($info->sign_date != $date){
                if ($info->sign_date == $yes_date){
                    $data['day'] = $info->day+1;
                    $data['integral'] = $info->integral+($info->day+1);
                } else {
                    $data['integral'] = $info->integral+($data['day']);
                }
                $data['number'] = $info->number+1;
                $result = DB::table('sign')->where('uid' , $uid)->update($data);
            } else {
                return ['msg'=>'您今日已签到'];
            }
        }
        if ($result){
            return ['msg'=>'今日已签到,获得积分'.$data['integral'].'分'];
        } else {
            return ['msg'=>'签到失败'];
        }
    }


}
