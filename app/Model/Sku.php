<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    //定义变量
    protected $tableName = 'skus';
    protected $primaryKey = 'sku_id';
    public $timestamps = false;
}
