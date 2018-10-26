<?php
namespace App\Services\Home;

use App\Model\Good;
use App\Model\Type;

class IndexService
{
    /**
     * 获取所有类型
     */
    public function getTypesInfo()
    {
        $typesInfo = Type::where(['parent_id'=>0])->paginate(8);
        return $typesInfo;
    }

    /**
     * 获取所有商品信息
     */
    public function getAllGoodsInfo()
    {
        // $allGoodsInfo = Brand::get()->good;
        $allGoodsInfo = Type::join('goods', 'goods.type_id', '=', 'types.type_id')->get();
        $allGoodsInfo = $this->getTree($allGoodsInfo);
        return $allGoodsInfo;
    }

    /**
     * 处理对象
     */
    function getTree($data)
    {
        foreach ($data as $key => $item) {
            $types[] = $item->type_name;
        }
        $allGoodsInfo = [];
        foreach (array_unique($types) as $key => $item) {
            foreach ($data as $k => $v) {
                if ($v->type_name == $item) {
                    $allGoodsInfo[$item][] = $v;
                }
            }
        }
        return $allGoodsInfo;
    }
}