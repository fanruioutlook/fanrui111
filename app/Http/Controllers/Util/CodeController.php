<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
        private function random($len=4){
            $str='';
            for($i=0;$i<$len;$i++){
                $str.=mt_rand(0,9);
            }
            return $str;


        }

        public function send(Request $request){

            $code=$this->random();

//            user模型对象
            //验证码的下标就叫username，来源不一样
            $user=User::firstOrNew(['email'=>$request->username]);
//            dd($request->username);
            $user->notify(new RegisterNotify($code));
            session()->put('code',$code);
//            dd(session()->put('code',$code));
            return ['code'=>1,'message'=>'验证码发送成功'];







        }
}
