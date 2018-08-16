<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class AddressController extends Controller{
    //
    public function index(){
        $username = Session::get('username');
        $user_info = DB::table('user')->where('username',$username)->first();
        $address_list = DB::table('address')->where('u_id',$user_info->id)->get();
        // dd($address_list);
        return view('phone.address.index' , ['title'=>'收货地址列表' , 'addresslist'=>$address_list]);
    }

    public function add(){
        return view('phone.address.add' , ['title'=>'添加收货地址']);
    }

    public function detail(){
        $id = Input::get('add_id');
        // echo $id;die;
        $address_info = DB::table('address')->where('id' , $id)->first();
        return view('phone.address.detail' , ['title'=>'收货地址详情' , 'address_info'=>$address_info]);
    }

    public function edit(){
        $id = Input::get('add_id');
        $address_info = DB::table('address')->where('id' , $id)->first();
        $province = DB::table('area')->where('area_parent_id' , 0)->get();
        return view('phone.address.edit' , ['title'=>'编辑收货地址' , 'province'=>$province , 'address_info'=>$address_info]);
    }

    public function city(){
        $parent_id = Input::post('parent_id');
        $data = DB::table('area')->where('area_parent_id' , $parent_id)->get();

        $str = "";
        foreach ($data as $key => $value) {
            $str .= "<option value='$value->id'>$value->area_name</option>";
        }

        // dd($city);
        return ['data'=>$str];
    }
}
