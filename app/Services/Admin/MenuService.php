<?php
namespace App\Services\Admin;

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
}