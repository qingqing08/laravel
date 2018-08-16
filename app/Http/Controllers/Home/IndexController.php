<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller{
    //


    public function index(){
        return view('home.index' , ['title'=>'后台首页']);
    }

    public function welcome(){
        return view('home.welcome');
    }

    public function statistics(){
        $start = strtotime(date("Y-m-d") , time());
        $end = $start+60*60*24;

        $count = 0;
        $phone_count = 0;
        $web_count = 0;

        $order_list = DB::table('ordercontent')->whereBetween('time' , [$start,$end])->get();
        $order_list = $order_list->toArray();
        if (!empty($order_list)){
            $count = count($order_list);
            foreach ($order_list as $value){
                if ($value->is_mobile == 1){
                    $phone_count++;
                } else {
                    $web_count++;
                }
            }
            $rs['sum'] = $count; //总数
            $rs['phone_count'] = $phone_count; //单个数
            $rs['web_count'] = $web_count; //单个数
            $phone_count = round($rs['phone_count']/$rs['sum']*100,2);
            $web_count = round($rs['web_count']/$rs['sum']*100,2);

        }

        $date = date('Y-m-d' , $start);
        $data = [
            'date'  =>  date('Y-m-d' , $start),
            'count' =>  $count,
            'phone_count'   =>  $phone_count."%",
            'web_count' =>  $web_count.'%',
            'time'      =>  time(),
        ];

        $info = DB::table('count')->where('date' , $date)->first();
        if (empty($info)){
            $result = DB::table('count')->insert($data);
        } else {
            $result = DB::table('count')->where('date' , $date)->update($data);
        }
        echo $date."<br>";
        echo "手机".$phone_count."%<br>";
        echo "电脑".$web_count."%";
    }

    public function log(){
        $filename = "./access.log";

        $data = file_get_contents($filename);
//        dd($data);
//        echo $data;die;
        $type = ['Windows NT 10.0' , 'iPhone' , 'Linux'];

        $preg_server = '/\(.+;/US';
        $preg_date = '/\[.+]/U';
        $preg_all = '/(\[.+])|(\(.+;)/U';
        preg_match_all($preg_server , $data , $server);
        preg_match_all($preg_date , $data , $date);
        preg_match_all($preg_all , $data ,$all);

//        foreach ($server as $value){
//            $arr = $value;
//        }
//        $iphone = 0;
//        $web = 0;
//        for ($i=0;$i<count($arr);$i++){
//            $arr[$i] = trim($arr[$i] , '(');
//            $arr[$i] = trim($arr[$i] , ';');
//            echo $arr[$i];
//            if ($arr[$i] == 'iPhone' || $arr[$i] == 'Linux'){
//                $iphone++;
//            }
//            if ($arr[$i] == 'Windows NT 10.0' || $arr[$i] == 'X11'){
//                $web++;
//            }
//        }
//        echo count($arr)."<br>";
//        echo $iphone."<br>";
//        echo $web."<br>";
        $new_arr = array_merge($server , $date);
        dd($all);
        echo $data;
    }
}
