<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/time', function () {
    return view('index');
});

Route::get('warning','WarningController@index');

Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');//首页展示
    Route::match(['get','post'],'users/login','UsersController@login');//用户登录功能
    Route::match(['get','post'],'users/register','UsersController@register');//用户注册功能
    Route::get('users/loginout','UsersController@loginout');//用户退出哈哈
    Route::post('users/checkCaptcha','UsersController@checkCaptcha');//验证验证码
    Route::get('users/self','UsersController@self');//个人中心
});