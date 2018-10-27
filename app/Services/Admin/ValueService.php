<?php
namespace App\Services\Admin;

use App\Model\Value;
use App\Model\Attr;
use DB;

class ValueService
{
    /**
     * 修改属性值
     */
    public function createAttrValue($attr_id,$attr_values)
    {
        DB::beginTransaction();
        try {
            Value::where(['attr_id'=>$attr_id])->delete();
            foreach ($attr_values as $key => $value) {
                $valueInfos[$key]['attr_id'] = $attr_id;
                $valueInfos[$key]['attr_val_name'] = $value;
            }
            Value::where(['attr_id'=>$attr_id])->insert($valueInfos);
            $result = true;
            DB::commit();
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 通过分类id获取属性值
     */
    public function getValueById($attrId)
    {
        $values = Value::orderBy('attr_val_id')->where(['attr_id'=>$attrId])->get();
        $valueStr = '';
        foreach ($values as $key => $value) {
            $valueStr .= '-'.$value->attr_val_name;
        }
        return ltrim($valueStr,'-');
    }
}