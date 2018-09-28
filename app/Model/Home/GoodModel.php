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
     * 通过type获取商品列表
     */
    public function getRows($type)
    {
        $goodsList = DB::table($this->table)->where('good_type',$type)->get();
        return $goodsList;
    }
    
    /**
     * 通过商品id获取商品详细信息
     */
    public function getDetail($good_id)
    {
        $goodDetail = DB::table($this->table)->where($this->primaryKey,$good_id)->first();
        return $goodDetail;
    }
}
