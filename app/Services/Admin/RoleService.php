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
        $role_name = $request->input('role_name');
        $role = new Role();
        $roleId = $role->getInsertId(['role_name'=>$role_name]);
        $menus = $request->input('menus');
        foreach($menus as $key => $item) {
            $data[$key]['role_id'] = $roleId;
            $data[$key]['resource_id'] = $item;
        }
        $resource = new Resource();
        return $resource->insertAccess($data);
    }

    /**
     * 添加权限
     */
    public function insertAccess()
    {

    }
}