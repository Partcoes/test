<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodModel extends Model
{
    //指定表名
    protected $table = 'goods';

    //指定主键
    protected $primaryKey = 'good_id';

    /**
     * 通过type获取用户列表
     */
    public function getRows($type)
    {
        $goodsList = DB::table($this->table)->where('good_type',$type)->get();
        return $goodsList;
    }
}
