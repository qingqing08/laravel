<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller{
    //
    public function goods_add(){
        $typelist = DB::table('type')->get();
        return view('home.goodsadd' , ['typelist'=>$typelist]);
    }

    public function goods_add_do(Request $request){
        $file = $request->file('image');
//        dd($file);die;
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            //这里的uploads是配置文件的名称
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
//            var_dump($bool);

        }

        $data = [
            'name'  =>  Input::post('name'),
            'num'  =>  Input::post('num'),
            'type_id'  =>  Input::post('type_id'),
            'in_price'  =>  Input::post('in_price'),
            'out_price'  =>  Input::post('out_price'),
            'image_url' =>  'uploads/'.$filename,
            'ctime'  =>  time(),
        ];

        $res = DB::table('goods')->insert($data);

        if ($res){
            echo "添加成功";
        } else {
            echo "添加失败";
        }
    }
}
