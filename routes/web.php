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

Route::get('/', function () {
    return view('welcome');
});
Route::get('hello',function(){
    return "Hello World!!!";
});
Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');//前台首页
    Route::get('users/login',function(){
        return view('home.users.login');
    });//用户登录页面
    Route::get('users/register',function(){
        return view('home.users.register');
    });//用户注册页面
    Route::resource('goods','GoodsController');//商品资源
    Route::resource('users','UsersController');//用户资源
});