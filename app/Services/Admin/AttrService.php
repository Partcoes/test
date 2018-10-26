<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;
use \App\Model\Value;

class AttrService
{
    /**
     * 查找所有品牌
     */
    public function getAttrs()
    {
        return Attr::get();
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
        return Attr::where(['attr_id'=>$attrId])->delete();
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
}