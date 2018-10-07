<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Home\UserService;
use App\Model\Home\UserModel;

class UsersController extends Controller
{
    private $userService;
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * 用户登录页面
     */
    public function login(Request $request)
    {
        $userInfo = $request->input();
        if ($userInfo) {
            $res = $this->userService->userLogin($request,$userInfo);
            if ($res) {
                return "登陆成功";
            } else {
                return "登录失败";
            }
        }
        return view('home.users.login');
    }

    /**
     * 用户注册页面
     */
    public function register(Request $request)
    {
        $userRegisterInfo = $request->input();
        if($userRegisterInfo) {
            $pregEmail = '/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/';
            $pregPwd = '/^[a-zA-Z\d_\.\/]{8,}$/';
            $pregTel = '/^[\d]{11}$/';
            if (preg_match($pregEmail,$userRegisterInfo['user_name'])) {
                //用户通过邮箱注册
                echo "用户通过邮箱注册";
            } else if (preg_match($pregTel,$userRegisterInfo['user_name'])) {
                //用户通过手机号码注册
                echo "用户通过手机号码注册";
            } else {
                return "请输入合适的用户名以便注册";
            }
            if (preg_match($pregPwd,$userRegisterInfo['user_pwd']) && preg_match($pregPwd,$userRegisterInfo['user_repwd']) && $userRegisterInfo['user_pwd'] == $userRegisterInfo['user_repwd']) {
                $res = $this->userService->saveRegisterInfo($userRegisterInfo);
                if ($res) {
                    return "注册成功";
                } else {
                    return "注册失败";
                }
            } else {
                return "请保证其他信息有效";
            }
        }
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
     * 验证用户唯一
     */
    public function rename(Request $request)
    {
        $userName = $request->input('userName');
        $userModel = new UserModel();
        $userInfo = $userModel->getUserInfoByName($userName);
        return json_encode($userInfo);
    }
}
