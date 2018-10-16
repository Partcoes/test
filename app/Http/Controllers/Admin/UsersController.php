<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;

class UsersController extends Controller
{
    //定义service变量
    protected $userService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * 用户登录
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'email' => 'regex:/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',
                'password' => 'required',
            ],[
                'email.regex' => '请输入正确的邮箱',
                'password.required' => '请输入密码'
            ]);
            $result = $this->userService->userLogin($request);
            if ($result) {
                return redirect('/warning')->with(['message'=>'登录成功','url'=>'/admin','jumpTime'=>3,'status'=>true]);
            } else {
                return redirect('/warning')->with(['message'=>'登录失败','url'=>'/admin/login','jumpTime'=>3,'status'=>false]);
            }
        }
        return view('admin.users.login');
    }

    /**
     * 添加管理员
     */
    public function create()
    {
        return view('admin.users.managercreate');
    }

    /**
     * 退出登录
     */
    public function loginout()
    {
        session()->forget('managerInfo');
        return redirect('/warning')->with(['message'=>'退出成功，欢迎使用','url'=>'/admin/login','jumpTime'=>3,'status'=>true]);
    }
}
