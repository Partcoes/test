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
        $menu = new Menu();
        if ($request->input('parent_id') != 0) {
            $path = $menu->getParentPath($request->input('parent_id'));
        }
        $path = isset($path)?$path:0;
        $data = [
            'menu_name' => $request->input('menu_name'),
            'menu_uri' => $request->input('menu_uri'),
            'is_menu' => $request->input('is_menu'),
            'parent_id' => $request->input('parent_id'),
            'path' => $path,
        ];
        DB::beginTransaction();
        try {
            $menu_id = $menu->createMenu($data);
            $path = $path?$path.'-'.$menu_id:$menu_id;
            $result = Menu::where(['menu_id'=>$menu_id])->update(['path'=>$path]);
            DB::commit();
            
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
        
    }
}