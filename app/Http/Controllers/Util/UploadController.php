<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    //处理上传
    public function uploader(Request $request){
//        dd(11);文件名不对，store（）就是一个空
//      $path =$request->file('avatar')->store('avatars');
//      dd($path);
//        dd($_FILES);
        $file=$request->file('file');
        //对上传文件的大小以及类型拦截
        $this->checkSize($file);
        $this->checkType($file);
//      dd(111);
        if($file){
            $path=$file->store('attachment','attachment');
            //将上传数据存储到数据表
            //我们创建附件的模型与迁移文件
            //关联添加
            auth()->user()->attachment()->create([
                'name'=>$file->getClientOriginalName(),
                'path'=>url($path)
            ]);
        }
//        dd($path);
        return ['file' =>url($path), 'code' => 0];

    }
    //验证上传大小
    private function checkSize($file){
//        $file->getSize();//获取上传文件大小
        if($file->getSize() > 200000){

//            return ['message'=>'上传文件过大','code'=>403];
            throw new UploadException('上传文件过大');
        }
    }
    private function checkType($file){
            if(!in_array(strtolower($file->getClientOriginalExtension()),['jpg','png'])){
//                return ['message'=>'类型不允许','code'=>403 ];
                return new UploadException('类型不允许');
            }

    }
    //获取图片列表
    public function filesLists(){
            $files=auth()->user()->attachment()->paginate(2);
            $data=[];//给数组追加元素，追加就需要先声明
            foreach ($files as $file){
                $data[]=[
                    'url'=>$file['path'],
                    'path'=>$file['path']
                ];
            }
        return [
            'data'=>$data,
            'page'=>$files->links() . '',//这里要用在js里面，一定要注意分页后面拼接一个空字符串
            'code'=> 0
        ];
    }
}
