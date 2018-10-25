<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    //定义变量
    protected $tableName = 'attrs';
    protected $primaryKey = 'attr_id';
    public $timestamps = false;

    /**
     * 关联属性值
     */
    public function values()
    {
        return $this->hasMany('\App\Model\Value','attr_id','attr_id');
    }

    /**
     * 关联类型
     */
    public function types()
    {
        return $this->hasOne('\App\Model\Type','type_id','type_id');
    }
}
