<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Home\UserService;

class UsersController extends Controller
{
    //定义变量
    protected $userService;

    /**
     * 实例化模型
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
        if ($request->isMethod('POST')) {
            $this->validate($request,[
                'user_name' => 'required',
                'user_pwd' => 'required',
            ]);
            $result = $this->userService->userLogin($request);
            if ($result) {
                return redirect('/warning')->with(['message'=>'登录成功','url'=>'/','jumpTime'=>3,'status'=>true]);
            } else {
                return redirect('/warning')->with(['message'=>'登录失败','url'=>'/users/login','jumpTime'=>3,'status'=>false]);
            }
        }
        return view('home.users.login');
    }

    /**
     * 用户注册
     */
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
                $this->validate($request,[
                    'user_name' => [ 'regex:/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+ || 1[3-9]{2}[0-9]{8}$/'],
                    'user_pwd' => ['regex:/^[a-zA-Z\d_\.\/]{8,}$/'],
                    'user_re_pwd' => ['same:user_pwd','regex:/^[a-zA-Z\d_\.\/]{8,}$/'],
                ]);
                $data = $this->userService->saveRegisterInfo($request);
                if (isset($data['user_email'])) {
                    return redirect('/warning')->with(['message'=>'感谢你通过邮箱注册我们的账号，请进入邮箱确认','url'=>'/','jumpTime'=>3,'status'=>true]);
                } else if (isset($data['user_mobile'])) {
                    return redirect('/warning')->with(['message'=>'感谢你通过手机号码注册','url'=>'/','jumpTime'=>3,'status'=>true]);
                } else {
                    return redirect('/warning')->with(['message'=>'注册失败或该用户已经存在','url'=>'/users/register','jumpTime'=>3,'status'=>false]);
                }
        }
        return view('home.users.register');
    }

    /**
     * 验证码验证
     */
    function checkCaptcha(Request $request)
    {
        $this->validate($request,[
            'captcha' => 'required | captcha',
        ]);
        return 1;
    }

    /**
     * 个人中心
     */
    public function self()
    {
        if (session()->get('userInfo')) {
            return view('home.users.self');
        } else {
            return redirect('/warning')->with(['message'=>'请先登录','url'=>"/users/login",'jumpTime'=>3,'status'=>false]);
        }
    }

    /**
     * 退出登录
     */
    public function loginout()
    {
        session()->forget('userInfo');
        return redirect('/warning')->with(['message'=>'退出成功','url'=>"/",'jumpTime'=>3,'status'=>true]);
    }
}
