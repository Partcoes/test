<?php
namespace App\Services\Admin;

use App\Model\Manager;
use App\Model\Role;
use App\Model\Menu;
use App\Model\Button;
use App\Model\Resource;
use DB;

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
     * 通过id获取角色信息
     */
    public function getRoleInfoById($roleId)
    {
        return Role::where(['role_id'=>$roleId])->first();
    }

    /**
     * 创建角色
     */
    public function createRole($request)
    {
        $role = new Role();
        $role_name = $request->input('role_name');
        $roleInfo = Role::where(['role_name'=>$role_name])->first();
        if (isset($roleInfo->role_id)) {
            $roleId = $roleInfo->role_id;
            Resource::where(['role_id'=>$roleId])->delete();
        } else {
            $roleId = $role->getInsertId(['role_name'=>$role_name]);
        }
        $menus = $request->input('menus');
        $menus = Menu::whereIn('menu_id',$menus)->get();
        foreach($menus as $key => $item) {
            $data[$key]['role_id'] = $roleId;
            $data[$key]['resource_id'] = $item->menu_id;
            $data[$key]['resource_type'] = $item->is_menu;
        }
        $resource = new Resource();
        return $resource->insertAccess($data);
    }

    /**
     * 获取角色所拥有权限
     */
    public function getRoleAccess($roleId)
    {
        $roleHasAccess = Resource::where(['resources.role_id'=>$roleId])
        ->leftJoin('menus','resources.resource_id','=','menus.menu_id')
        ->leftJoin('roles','resources.role_id','=','roles.role_id')
        ->orderBy('menus.path')
        ->get();
        return $roleHasAccess;
    }

    /**
     * 删除角色所有信息
     */
    public function deleteRole($roleId)
    {
        $role = new Role();
        DB::beginTransaction();
        try {
            Role::where(['role_id'=>$roleId])->delete();
            Resource::where(['role_id'=>$roleId])->delete();
            $role->removeManagerToRole($roleId);
            $result = true;
            DB::commit();
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }
}