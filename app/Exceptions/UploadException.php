<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
    //异常处理设置后可以阻断程序后抛出，而return有时却不行，如果return返回后的上一层，下面有程序，程序就会继续往下跑，return异常就显示不出来
    public  function render(){
        //return response()->json(['message' =>'上传文件过大', 'code' => 403],200);
        //return response()->json(hdjs要求返回,http状态码);
        return response()->json(['message'=>$this->getMessage(),'code'=>403],200);
    }
}
