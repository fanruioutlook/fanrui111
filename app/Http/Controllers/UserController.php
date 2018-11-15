<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(){
        return view('user.register');
    }
    public function login(){
        return view('user.login');
    }
    public function store(UserRequest $request){
        $data=$request->all();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('login')->with('success','注册成功');

    }
    public function loginFrom(Request $request){

        $this->validate($request,[
        'email'=>'email',
        'password'=>'required|min:3'
            ],[
            'email.email'=>'请输入邮箱',
            'password.required'=>'请输入登录密码',
            'password.min'=>'密码不得少于3位置'
        ]);
        $credentials=$request->only('email','password');
        if(\Auth::attempt($credentials)){
            return redirect()->route('home')->with('success','登陆成功');
        }
            return redirect()->back()->with('danger','用户名密码不正确');


    }
    public function passwordReset(){
        return view('user.password_reset');
    }
    public function passwordResetFrom(PasswordResetRequest $request){
        $user=User::where('email',$request->email)->first();
        if($user){
            $user->password=bcrypt($request->password);
            $user->save();
            return redirect()->route('login')->with('success','密码重置成功');
        }
        return redirect()->back()->with('danger','该邮箱未注册');
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('home');

    }


}
