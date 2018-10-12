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
        $allGoodsInfo = Brand::get();
        return $allGoodsInfo;
    }

    /**
     * 无限极分类
     */
    public function getGroupInfo()
    {

    }
}