<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\TypeService;
use App\Services\Admin\AttrService;
use App\Services\Admin\ValueService;

class GoodsController extends Controller
{
    //定义变量
    protected $goodService;
    protected $attrService;
    protected $typeService;
    protected $valueService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->goodService = new GoodService();
        $this->attrService = new AttrService();
        $this->typeService = new TypeService();
        $this->valueService = new ValueService();
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
        $types = $this->typeService->getTypes();
        $attrs = $this->attrService->getAttrs();
        return view('admin.goods.goodscreate',['types'=>$types,'attrs'=>$attrs]);
    }

    /**
     * sku管理页面
     */
    public function sku(Request $request)
    {
        $allAttrData = $request->input();
        unset($allAttrData['_token']);
        foreach ($allAttrData as $value) {
            $skuList[] = $this->valueService->getSkuList($value);
        }
        if (!$skuList[0]) {
            return 'false';
        }
        return $skuList;
    }

    /**
     * 商品信息添加
     */
    public function store(Request $request)
    {
        dd($request->file());
    }
}
