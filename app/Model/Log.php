<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Log extends Model
{
    //定义变量
    protected $tableName = 'logs';
    protected $primaryKey = 'log_id';

    /**
     * 保存用户登录日志
     */
    public function saveLoginLog($log)
    {
        $result = DB::table($this->tableName)->insertGetId($log);
        return $result;
    }
}
