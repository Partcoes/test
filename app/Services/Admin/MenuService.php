<?php
namespace App\Services\Admin;

use DB;
use App\Model\Manager;
use App\Model\Role;
use App\Model\Menu;
use App\Model\Button;
use App\Model\Resource;

class MenuService
{
    /**
     * 获取所有权限
     */
    public function getMenus()
    {
        return Menu::orderBy('path')->get();
    }

    /**
     * 添加菜单
     */
    public function createMenu($request)
    {
        $menuInfo = $request->input();
        $menu = Menu::where(['menu_uri'=>$menuInfo['menu_uri']])->first();
        if  (!isset($menu->menu_id)) {
            $menu = new Menu();
        }
        if ($request->input('parent_id') != 0) {
            $path = $menu->getParentPath($request->input('parent_id'));
        }
        $path = isset($path)?$path:0;
        $menu->menu_name = $menuInfo['menu_name'];
        $menu->menu_uri = $menuInfo['menu_uri'];
        $menu->is_menu = $menuInfo['is_menu'];
        $menu->parent_id = $menuInfo['parent_id'];
        $menu->path = $path;
        $menu->save();
        DB::beginTransaction();
        try {
            $menu_id = $menu->menu_id;
            $path = $path?$path.'-'.$menu_id:$menu_id;
            $result = Menu::where(['menu_id'=>$menu_id])->update(['path'=>$path]);
            DB::commit();
            
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 删除菜单
     */
    public function removeMenu($menuId)
    {
        $menu = new Menu();
        DB::beginTransaction();
        try {
            Menu::where(['menu_id'=>$menuId])->delete();
            Resource::where(['resource_id'=>$menuId])->delete();
            $result = true;
            DB::commit();
            
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 通过id获取菜单信息
     */
    public function menuInfo($menuId)
    {
        return Menu::where(['menu_id'=>$menuId])->first();
    }
}