<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\MenuService;

class MenusController extends Controller
{
    //定义service变量
    protected $menuService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->menuService = new MenuService();
    }

    /**
     * 展示所有菜单
     */
    public function index()
    {
        $menus = $this->menuService->getMenus();
        return view('admin.menus.menuslist',['menus'=>$menus]);
    }
}
