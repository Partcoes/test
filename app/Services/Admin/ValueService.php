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

    /**
     * 获取sku列表
     */
    public function getSkuList($data)
    {
        if (!empty($data)) {
            if (count($data) == 1) {
                foreach ($data as $key => $value) {
                    $skuList = $value;
                }
            } else {
                $skuList = $this->CartesianProduct(array_values($data));
            }
        } else {
            return false;
        }
        return $skuList;
    }

    /**
     * 计算多个集合的笛卡尔积
     */
    public function CartesianProduct($data){
        // 保存结果
        $result = array();
        // 循环遍历集合数据
        for($i=0,$count=count($data); $i<$count-1; $i++){
            // 初始化
            if($i==0){
                $result = $data[$i];
            }
            // 保存临时数据
            $tmp = array();
            // 结果与下一个集合计算笛卡尔积
            foreach($result as $res){
                foreach($data[$i+1] as $set){
                    $tmp[] = $res.','.$set;
                }
            }
            // 将笛卡尔积写入结果
            $result = $tmp;
        }
        return $result;
    }
}