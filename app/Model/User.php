<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    //定义变量
    protected $tableName = 'users';
    protected $primaryKey = 'user_id';

    /**
     * 添加用户信息
     */
    public function register($userInfo)
    {
        $result = DB::table($this->tableName)->insertGetId($userInfo);
        return $result;
    }

    /**
     * 判断用户是否存在
     */
    public function userIsset($userInfo)
    {
        $userId = DB::table($this->tableName)->where($userInfo)->value($this->primaryKey);
        if ($userId) {
            return $userId;
        } else {
            return false;
        }
    }

    /**
     * 通过用户名获取用户信息
     */
    public function getUserInfoByName($userName)
    {
        $userInfo = DB::table($this->tableName)->where('user_email',$userName)->orWhere('user_mobile',$userName)->first();
        if ($userInfo) {
            return $userInfo;
        } else {
            return false;
        }
    }

    /**
     * 通过用户ID获取用户信息
     */
    public function getUserInfoById($id)
    {
        $userInfo = DB::table($this->tableName)->where($this->primaryKey,$id)->first();
        return $userInfo;
    }
}
