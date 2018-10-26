<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\BrandService;
use App\Services\Admin\AttrService;

class GoodsController extends Controller
{
    //定义变量
    protected $goodService;
    protected $brandService;
    protected $attrService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->goodService = new GoodService();
        $this->brandService = new BrandService();
        $this->attrService = new AttrService();
    }

    /**
     * 商品列表展示
     */
    public function list()
    {
        $goodsList = $this->goodService->GoodsListPagenate();
        return view('admin.goods.goodslist',['goodsList'=>$goodsList]);
    }

    /**
     * 创建商品
     */
    public function create()
    {
        $brands = $this->brandService->getBrands();
        $attrs = $this->attrService->getAttrs();
        return view('admin.goods.goodscreate',['brands'=>$brands,'attrs'=>$attrs]);
    }
}
