<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Home\IndexService;
use App\Services\Home\UserService;

class IndexController extends Controller
{
    //定义变量
    protected $indexService;
    protected $userService;
    /**
     * 自动初始化Service
     */
    public function __construct()
    {
        $this->indexService = new IndexService();
        $this->userService = new UserService();
    }

    /**
     * 小米商城首页展示
     */
    public function index()
    {
        $typesInfo = $this->indexService->getTypesInfo();
        $allGoodsInfo = $this->indexService->getAllGoodsInfo();
        return view('home.index.index',['typesInfo'=>$typesInfo,'allGoodsInfo'=>$allGoodsInfo]);
    }
}
