<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AssortController extends Controller{
    //
    public function assort(){
        $typelist = DB::table('type')->where('status',1)->get();
        foreach ($typelist as $type){
            $type->goodslist = DB::table('goods')->where(['type_id'=>$type->id , 'status'=>1])->get();
        }

//        dd($typelist);
//        $goodslist = DB::table('goods')->get();
        return view('phone.assort', ['title'=>'分类' , 'typelist'=>$typelist]);
    }
}
