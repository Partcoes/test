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
    Route::get('/','IndexController@index');
    Route::match(['get','post'],'users/login','UsersController@login');
    Route::match(['get','post'],'users/register','UsersController@register');
    Route::get('users/loginout','UsersController@loginout');
    Route::post('users/checkCaptcha','UsersController@checkCaptcha');
    Route::get('users/self','UsersController@self');
    Route::get('users/signin','UsersController@signin');
});