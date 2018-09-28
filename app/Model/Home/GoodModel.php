<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class GoodModel extends Model
{
    //指定表名
    protected $table = 'goods';

    //指定主键
    protected $primaryKey = 'good_id';
}
