<?php
namespace App\Services\Home;

use App\Model\Home\UserModel;

class UserService
{
    //定义模型变量
    public $userModel;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * 注册信息用户
     */
    public function saveRegisterInfo($userInfo)
    {
        unset($userInfo['_token']);
        unset($userInfo['user_repwd']);
        unset($userInfo['verification']);
        $userInfo['user_pwd'] = md5($userInfo['user_pwd']);
        $userInfo['createtime'] = time();
        $userInfo['updatetime'] = time();
        $res = $this->userModel->Register($userInfo);
        return $res;
    }
}