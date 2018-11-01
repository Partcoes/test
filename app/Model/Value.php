<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    //定义变量
    protected $tableName = 'values';
    protected $primaryKey = 'attr_val_id';
    public $timestamps = false;

    /**
     * 对应attr表
     */
    public function attr()
    {
        return $this->hasOne('App\Model\Attr','attr_id','attr_id');
    }
}
