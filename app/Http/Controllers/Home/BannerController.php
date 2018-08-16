<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

/**
 *轮播图管理
 * */
class BannerController extends Controller{
    //
    public function banner_list(){

    }

    public function banner_add(){
        return view('home.banner.add' , ['title'=>'轮播图上传']);
    }

    public function banner_add_do(Request $request){
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
            'title'  =>  Input::post('title'),
            'image_url' =>  'uploads/'.$filename,
            'ctime'  =>  time(),
        ];

        $result = DB::table('banner')->insert($data);

        if ($result){
            echo "上传成功";
        } else {
            echo "上传失败";
        }



    }
}
