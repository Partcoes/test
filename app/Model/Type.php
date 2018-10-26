<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Type extends Model
{
    //定义变量
    protected $tableName = 'types';
    protected $primaryKey = 'type_id';

    //是否自动添加时间戳
    public $timestamps = false;

    /**
     * 关联类型
     */
    public function attrs()
    {
        return $this->belongsToMany('\App\Model\Attr','type_attr','type_id','attr_id');
    }

    /**
     * 分配属性
     */
    public function getAttrsForType($typeId,$attrs)
    {
        foreach ($attrs as $key => $value) {
            $typeAttrs[$key]['type_id'] = $typeId;
            $typeAttrs[$key]['attr_id'] = $value;
        }
        return DB::table('type_attr')->insert($typeAttrs);
    }

    /**
     * 删除分类属性关系
     */
    public function deleteReletive($typeId)
    {
        return DB::table('type_attr')->where(['type_id'=>$typeId])->delete();
    }
}
