<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{
    //设置表名
    protected $table = 'menus';
    //设置主键
    protected $primaryKey = 'menu_id';
    //是否自动添加时间戳
    public $timestamps = false;

    /**
     * 获取父元素path
     */
    public function getParentPath($parent_id)
    {
        $path = DB::table($this->table)->where(['menu_id'=>$parent_id])->select('path')->first()->path;
        return $path;
    }

    /**
     * 添加菜单
     */
    public function createMenu($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
}
