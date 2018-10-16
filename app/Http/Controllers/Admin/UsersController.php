<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class UsersController extends Controller
{
    /**
     * 用户登录页面
     */
    public function index()
    {
        // $adminUserInfo = ['user_name'=>'123','user_age'=>18];
        // session()->put('adminUserInfo',$adminUserInfo);
        return view('admin.users.index');
    }

    /**
     * 用户登录判断
     */
    public function store(Request $request)
    {
        $adminUserInfo = $request->input();
        dd($adminUserInfo);
    }
}
