<?php
namespace App\Services\Home;

use App\Model\User;
use App\Model\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\SendEmail;

class UserService
{
    use DispatchesJobs;
    //定义模型变量
    protected $userModel;
    protected $logModel;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->user = new User();
        $this->log = new Log();
    }

    /**
     * 注册信息用户
     */
    public function saveRegisterInfo($request)
    {
        $userInfo = $request->input();
        $hasUserInfo = $this->user->getUserInfoByName($userInfo['user_name']);
        if ($hasUserInfo) {
            return false;
        } else {
            $data = [
                'user_nickname' => 'mi_'.time().rand(10000,99999),
                'user_pwd' => md5($userInfo['user_pwd']),
                'createtime' => time(),
                'updatetime' => time(),
            ];
            if (preg_match('/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',$userInfo['user_name'])) {
                $data['user_email'] = $userInfo['user_name'];
                $this->sendEmail($data['user_email']);
            } else {
                $data['user_mobile'] = $userInfo['user_name'];
            }
            $userId = $this->user->register($data);
        }
        if ($userId) {
            $this->userLogin($request);
            return $data;
        } else {
            return false;
        }
    }

    /**
     * 验证用户登录
     */
    public function userLogin($request)
    {
        $userInfo = $request->input();
        if (preg_match('/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',$userInfo['user_name'])) {
            $data['user_email'] = $userInfo['user_name'];
        } else {
            $data['user_mobile'] = $userInfo['user_name'];
        }
        $data['user_pwd'] = md5($userInfo['user_pwd']);
        $userId = $this->user->userIsset($data);
        if (!$userId) {
            return false;
        }
        $userLoginLog = [
            'login_time' => time(),
            'login_ip' => $request->ip(),
            'user_id' => $userId,
        ];
        $result = $this->log->saveLoginLog($userLoginLog);
        if ($result) {
            $userInfo = $this->user->getUserInfoById($userId);
            session()->put('userInfo',$userInfo);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 队列发送邮件
     */
    public function sendEmail($userEmail)
    {
        $this->dispatch(new SendEmail($userEmail));
    }

    /**
     * 通过IP获取地址
     */
    public function getAddressByIp($ip)
    {
        $info = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
        return $info;
    }
}