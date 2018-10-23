<?php

namespace App\Model;
use DB;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //设置表名
    protected $table = 'roles';
    //设置主键
    protected $primaryKey = 'role_id';
    //是否自动添加时间戳
    public $timestamps = false;

    /**
     * 关联资源
     */
    public function resources()
    {
        return $this->hasMany('App\Model\Resource','role_id');
    }

    /**
     * 返回最后插入Id
     */
    public function getInsertId($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    /**
     * 删除角色对应的列表
     */
    public function removeManagerToRole($roleId)
    {
        return DB::table('manager2role')->where(['role_id'=>$roleId])->delete();
    }
}
