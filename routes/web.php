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

Route::get('warning','WarningController@index');

Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');//首页展示
    Route::match(['get','post'],'users/login','UsersController@login');//用户登录功能
    Route::match(['get','post'],'users/register','UsersController@register');//用户注册功能
    Route::get('users/loginout','UsersController@loginout');//用户退出
    Route::post('users/checkCaptcha','UsersController@checkCaptcha');//验证验证码
    Route::get('users/self','UsersController@self');//个人中心
    Route::get('users/signin','UsersController@signin');//用户签到
});

Route::match(['get','post'],'admin/login','Admin\UsersController@login');//后台用户登录
Route::get('admin/loginout','Admin\UsersController@loginout');//退出登录
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::get('/','IndexController@index');//后台首页
    Route::get('users/list','UsersController@index');//管理员列表
    Route::post('users','UsersController@store');//添加管理员
    Route::get('users/create','UsersController@create');//创建管理员表单
    Route::get('users/edit','UsersController@edit');//编辑管理员
    Route::post('users/freeze','UsersController@freeze');//冻结用户
    Route::post('users/delete','UsersController@delete');//删除用户
    Route::get('roles/list','RolesController@index');//角色列表
    Route::post('roles','RolesController@store');//添加角色
    Route::get('roles/create','RolesController@create');//创建角色表单
    Route::get('menus/list','MenusController@index');//菜单列表
    Route::post('menus','MenusController@store');//添加菜单
    Route::get('menus/create','MenusController@create');//创建菜单表单
    Route::match(['get','post'],'roles/update','RolesController@update');//修改角色权限
});