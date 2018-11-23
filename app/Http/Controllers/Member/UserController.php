<?php

namespace App\Http\Controllers\Member;

use App\Models\Article;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['edit','update','attention']
        ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $articles=Article::latest()->where('user_id',$user->id)->paginate(5);
        return view('member.user.show',compact('user','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,Request $request)
    {
            //调用策略
        $this->authorize('isMine',$user);
        //接收type参数，就是修改秘密、昵称、头像类别参数
        $type=$request->query('type');
        return view('member.user.edit_'.$type ,compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //请求到所有数据
        $data=$request->all();
        //调用策略
        $this->authorize('isMine',$user);
        $this->validate($request,[
            'password'=>'sometimes|required|min:3|comfirmed',
            'name'=>'sometimes|required'
        ],[
            'password.required'=>'请输入密码',
            'password.min'=>'密码不得小于3位',
            'password.comfirmed'=>'两次密码不一致',
            'name.required'=>'请输入昵称'
        ]);
        //密码加密
        if($request->password){
            $data['password']=bcrypt($data['password']);
        }
        //执行更新
        $user->update($data);
        return back()->with('success','操作成功');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    //关注 取消关注
    //这里user 被关注者
    public function attention(user $user){
//        auth()->user()->followering()->toggle($user);
        $this->authorize('isNotMine',$user);
        $user->fans()->toggle(auth()->user());
           return back();

    }
    public function myFans(User $user){
        //获取$user用户的粉丝

            $fans=$user->fans()->paginate(2);
            return view('member.user.my_fans',compact('user','fans'));

    }

    public function  myFollowing(User $user){
        //获取$user用户关注的人
        $followings=$user->following()->paginate(2);
        return view('member.user.my_following',compact('user','followings'));

    }
}
