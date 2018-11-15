<?php

Route::get('/','Home\HomeController@index')->name('home');
Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@store')->name('register');
Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@loginFrom')->name('login');
Route::get('/password_reset','UserController@passwordReset')->name('password_reset');
Route::post('/password_reset','UserController@passwordResetFrom')->name('password_reset');
Route::get('/logout','UserController@logout')->name('logout');

Route::any('/code/send','Util\CodeController@send')->name('code.send');
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'admin','as'=>'admin.'],function(){
    Route::get('index','IndexController@index')->name('index');
});

