<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Brand extends Model
{
    //定义变量
    protected $tableName = 'brands';
    protected $primaryKey = 'brand_id';
}