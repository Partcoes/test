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

    /**
     * 添加菜单
     */
    public function create()
    {
        $menus = $this->menuService->getMenus();
        return view('admin.menus.menucreate',['menus'=>$menus]);
    }

    /**
     * 添加菜单功能
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'menu_name' => 'required|unique:menus,menu_name',
                'menu_uri' => 'regex:/^\/admin(\/[a-z]{3,})+$/',
                'is_menu' => 'required',
                'parent_id' => 'required'
            ]);
            $result = $this->menuService->createMenu($request);
            if ($result) {
                return redirect('/warning')->with(['message'=>'添加成功','url'=>'/admin/menus/list','jumpTime'=>3,'status'=>'true']);
            } else {
                return redirect('/warning')->with(['message'=>'添加失败','url'=>'/admin/menus/create','jumpTime'=>3,'status'=>'false']);
            }
        }
    }
}
