<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;

class GoodService
{
    /**
     * 获取商品分页信息
     */
    public function GoodsListPagenate()
    {
        return Good::paginate(10);
    }
}