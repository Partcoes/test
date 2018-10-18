<?php
namespace App\Services\Admin;

use App\Model\Manager;
use App\Model\Role;
use App\Model\Menu;
use App\Model\Button;
use App\Model\Resource;

class RoleService
{
    /**
     * 获取所有角色
     */
    public function getAllRoles()
    {
        $roles = Role::get();
        return $roles;
    }

    /**
     * 创建角色
     */
    public function createRole($request)
    {
        $role = new Role();
        $role->role_name = $request->input('role_name');
        return $role->save();
    }
}