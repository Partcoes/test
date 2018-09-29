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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('hello',function(){
//     return "Hello World!!!";
// });
Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');//前台首页
    Route::get('users/login','UsersController@login');//用户登录页面
    Route::match(['get','post'],'users/register','UsersController@register');//用户注册页面
    Route::post('users/rename','UsersController@rename');//验证用户唯一
    Route::get('goods/{good_type}','GoodsController@list');//商品资源
    Route::get('good/{good_id}','GoodsController@detail');//商品详情
    Route::get('order/list','OrderController@list');//订单列表
    Route::get('order/self_info','UsersController@self');//用户信息
    Route::get('shopping','ShoppingController@index');//购物车资源
});