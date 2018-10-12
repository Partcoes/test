<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Good extends Model
{
    //定义变量
    protected $tableName = 'goods';
    protected $primaryKey = 'good_id';
}
