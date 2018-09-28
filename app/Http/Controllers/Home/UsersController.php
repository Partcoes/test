<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\UserModel;

class UsersController extends Controller
{
    /**
     * 用户登录页面
     */
    public function login()
    {
        return view('home.users.login');
    }

    /**
     * 用户注册页面
     */
    public function register()
    {
        return view('home.users.register');
    }

    /**
     * 使用模型查找用户信息
     */
    public function self()
    {
        $id = 1;
        $User = new UserModel();
        $userInfo = $User->getUserInfo($id);
        return view('home.users.self_info');
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        $userInfo = $request->input();
        dd($userInfo);
    }

    /**
     * 
     */
}
