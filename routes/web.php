<?php
//网站首页
Route::get('/','Home\HomeController@index')->name('home');
//前台
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function (){
    Route::get('/','HomeController@index')->name('index');
    //文章管理
    Route::resource('article','ArticleController');
});
//会员中心
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function (){

    //用户管理
    Route::resource('user','UserController');
    //定义关注、取消关注
   Route::get('attention/{user}','UserController@attention')->name('attention');
   //我的粉丝
   Route::get('get_fans/{user}','UserController@myFans')->name('my_fans');
   //我关注的人
   Route::get('get_following/{user}','UserController@myFollowing')->name('my_following');
});


//用户管理
Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@store')->name('register');
Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@loginFrom')->name('login');
Route::get('/password_reset','UserController@passwordReset')->name('password_reset');
Route::post('/password_reset','UserController@passwordResetFrom')->name('password_reset');
Route::get('/logout','UserController@logout')->name('logout');

//工具类
//Route::any('/code/send','Util\CodeController@send')->name('code.send');
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function (){
    //发送验证码
    Route::any('/code/send','CodeController@send')->name('code.send');
    //上传
    Route::any('/upload','UploadController@uploader')->name('upload');
    Route::any('/filesLists','UploadController@filesLists')->name('filesLists');

});

//后台路由
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
    Route::get('index','IndexController@index')->name('index');

    Route::resource('category','CategoryController');
});


