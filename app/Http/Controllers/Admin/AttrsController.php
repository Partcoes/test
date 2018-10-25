<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\BrandService;
use App\Services\Admin\AttrService;

class AttrsController extends Controller
{
    //定义变量
    protected $brandService;
    protected $goodService;
    protected $attrService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->brandService = new BrandService();
        $this->goodService = new GoodService();
        $this->attrService = new AttrService();
    }

    /**
     * 属性列表
     */
    public function list()
    {
        $attrs = $this->attrService->getAttrs();
        return view('admin.attrs.attrslist',['attrs'=>$attrs]);
    }
}
