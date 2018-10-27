<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Good extends Model
{
    //定义变量
    protected $tableName = 'goods';
    protected $primaryKey = 'good_id';
    public $timestamps = false;

    /**
     * 关联品牌表
     */
    public function types()
    {
        return $this->hasOne('\App\Model\Type','type_id','type_id');
    }
}
