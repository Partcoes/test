<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //设置主键
    protected $primaryKey = 'manager_id';
    //是否自动添加时间戳
    public $timestamps = false;
}
