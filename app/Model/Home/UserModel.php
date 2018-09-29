<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use DB;

//制定users表的模型
class UserModel extends Model
{
    //指定表名
    protected $table = 'users';

    //指定主键
    protected $primaryKey = 'user_id';

    public function getUserInfo($user_id)
    {
        $userInfo = DB::table($this->table)->where('user_id',$user_id)->first();
        return $userInfo;
    }
}
