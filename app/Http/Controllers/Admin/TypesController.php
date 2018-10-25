<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\TypeService;
use App\Services\Admin\AttrService;

class TypesController extends Controller
{
    //定义变量
    protected $typeService;
    protected $goodService;
    protected $attrService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->typeService = new TypeService();
        $this->goodService = new GoodService();
        $this->attrService = new AttrService();
    }

    /**
     * 商品分类展示
     */
    public function list()
    {
        $types = $this->typeService->getTypes();
        return view('admin.types.typelist',['types'=>$types]);
    }

    /**
     * 商品分类添加表单
     */
    public function create()
    {
        $types = $this->typeService->getTypes();
        return view('admin.types.typecreate',['types'=>$types]);
    }
}
