<?php
namespace App\Services\Home;

use App\Model\Good;
use App\Model\Type;
use App\Model\Brand;

class IndexService
{
    /**
     * 获取所有类型
     */
    public function getTypesInfo()
    {
        $typesInfo = Type::get();
        return $typesInfo;
    }

    /**
     * 获取所有商品信息
     */
    public function getAllGoodsInfo()
    {
        // $allGoodsInfo = Brand::get()->good;
        $allGoodsInfo = Brand::join('goods', 'goods.brand_id', '=', 'brands.brand_id')->get();
        $allGoodsInfo = $this->getTree($allGoodsInfo);
        return $allGoodsInfo;
    }

    /**
     * 处理对象
     */
    function getTree($data)
    {
        foreach ($data as $key => $item) {
            $brands[] = $item->brand_name;
        }
        $allGoodsInfo = [];
        foreach (array_unique($brands) as $key => $item) {
            foreach ($data as $k => $v) {
                if ($v->brand_name == $item) {
                    $allGoodsInfo[$item][] = $v;
                }
            }
        }
        return $allGoodsInfo;
    }
}