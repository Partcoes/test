<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;
use \App\Model\Value;
use DB;

class AttrService
{
    /**
     * 查找所有属性
     */
    public function getAttrs()
    {
        return Attr::where(['is_delete'=>1])->get();
    }

    /**
     * 添加属性入库
     */
    public function createAttr($request)
    {
        $attr = new Attr();
        $attr->attr_name = $request->input('attr_name');
        $attr->save();
        if (isset($attr->attr_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除属性
     */
    public function deleteAttr($attrId)
    {
        DB::beginTransaction();
        try {
            Attr::where(['attr_id'=>$attrId])->update(['is_delete'=>0]);
            Value::where(['attr_id'=>$attrId])->update(['is_delete'=>0]);
            $result = true;
            DB::commit();
            
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 通过id获取属性值
     */
    public function getAttrById($attrId)
    {
        return Attr::where(['attr_id'=>$attrId])->first();
    }

    /**
     * 编辑属性
     */
    public function updateAttr($attr_id,$attr_name)
    {
        Attr::where(['attr_id'=>$attr_id])->update(['attr_name'=>$attr_name]);
        return true;
    }
}