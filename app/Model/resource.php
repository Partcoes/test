<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Resource extends Model
{
    //设置表名
    protected $table = 'resources';
    //设置主键
    protected $primaryKey = 'resource_id';
    
    /**
     * 分配角色权限
     */
    public function insertAccess($data)
    {
        return DB::table($this->table)->insert($data);
    }
}
