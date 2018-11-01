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
        return $skuList;
    }

    /**
     * 文件上传
     */
    public function uploadImgs(Request $request)
    {
        return $request->file();
    }

    /**
     * 商品信息添加
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'good_name' => 'required',
                'good_price' => 'required',
                'type_id' => 'required',
                'attrs' => 'required',
                'attr_values' => 'required',
            ]);
        }
        $GoodInfo = $request->input();
        unset($GoodInfo['_token']);
        unset($GoodInfo['news']);

        dump($request->file());

        dd($GoodInfo);

        //调用方法获取sku数据
        $skuList = $this->goodService->createSkuList($GoodInfo);

        //计算总库存
        $good_num = 0;
        foreach ( $skuList as $key => $value ) {
            $good_num += $value['sku_inventory'];
        }

        //调用方法获取商品属性
        $goodAttrs = $this->goodService->createGoodAttr($GoodInfo['attr_values']);
        //调用方法获取商品信息
        $goodInfo = $this->goodService->createGoodInfo($GoodInfo,$good_num);
        //商品信息入库
        $result = $this->goodService->insertGoodInfo($skuList,$goodAttrs,$goodInfo);
        
        if ($result) {
            return redirect('/warning')->with(['message'=>'保存成功','url'=>'/admin/goods/list','jumpTime'=>3,'status'=>'true']);
        } else {
            return redirect('/warning')->with(['message'=>'保存失败','url'=>'/admin/goods/create','jumpTime'=>3,'status'=>'false']);
        }
    }

    /**
     * 商品详细信息展示
     */
    public function show(Request $request)
    {
        $goodId = $request->input('goodId');
        $goodInfo = $this->goodService->getGoodDetail($goodId);
        return view('admin.goods.gooddetail',['goodInfo'=>$goodInfo]);
    }
}
