<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Manager extends Model
{
    //设置表名
    protected $table = 'managers';
    //设置主键
    protected $primaryKey = 'manager_id';
    //是否自动添加时间戳
    public $timestamps = false;

    /**
     * 关联表
     */
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role','manager2role','manager_id','role_id');
    }

    /**
     * 添加数据并返回最后插入行id
     */
    public function addGetId($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    /**
     * 管理员分配权限
     */
    public function toRole($data)
    {
        return DB::table('manager2role')->insert($data);
    }

    /**
     * 删除对应角色
     */
    public function deleteRole($managerId)
    {
        return DB::table('manager2role')->where(['manager_id'=>$managerId])->delete();
    }
}
