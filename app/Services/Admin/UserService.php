<?php
namespace App\Services\Admin;

use App\Model\Manager;
use App\Model\Role;
use App\Model\Menu;
use App\Model\Button;
use App\Model\Resource;

class UserService
{

    /**
     * 用户登录
     */
    public function userLogin($request)
    {
        $formInfo = $request->input();
        $managerInfo = Manager::where(['manager_email'=>$formInfo['email'],'manager_pwd'=>md5($formInfo['password'])])->first();
        if (isset($managerInfo->manager_id)) {
            if ($managerInfo->is_freeze == 1) {
                return $result = ['status'=>0,'message'=>'账号已冻结','url'=>'admin/login'];
            }
            $managerInfo->last_login_time = time();
            $managerInfo->save();
            session()->put('managerInfo',$managerInfo);
            return $result = ['status'=>1,'message'=>'登录成功','url'=>'admin'];
        } else {
            return $result = ['status'=>0,'message'=>'账号不存在或者密码错误','url'=>'admin/login'];
        }
    }

    /**
     * 获取用户菜单权限
     */
    public function getUserMenu()
    {
        $managerInfo = session()->get('managerInfo');
        foreach ($managerInfo->roles as $key => $item) {
            $roles[$key] = $item->pivot->role_id;
        }
        $menus = Resource::leftJoin('menus','resources.resource_id','=','menus.menu_id')
        ->whereIn('role_id',$roles)
        ->where('resource_type',1)
        ->get();
        $menus = $this->createTree($menus);
        return $menus;

    }

    /**
     * 获取用户所有权限
     */
    public function getUserAccess()
    {
        $managerInfo = session()->get('managerInfo');
        foreach ($managerInfo->roles as $key => $item) {
            $roles[$key] = $item->pivot->role_id;
        }
        $menus = Resource::leftJoin('menus','resources.resource_id','=','menus.menu_id')
        ->whereIn('role_id',$roles)
        ->get();
        $menus = $this->createTree($menus);
        return $menus;

    }

    /**
     * 无限接分类
     */
    public function createTree($data,$parent_id = 0,$level = 0)
    {
        $tree = [];
        foreach ($data as $key => $value) {
            if ($value->parent_id == $parent_id) {
                $value->level = $level;
                $value->son = $this->createTree($data,$value->menu_id,$level+1);
                $tree[] = $value;
            }
        }
        return $tree;
    }

    /**
     * 生成菜单数据
     */
    public function createMenus($data = '')
    {
        $menus = [];
        foreach ($data as $key => $value) {
            $menus[$key] = ['text'=>$value->menu_name,'url'=>$value->menu_uri,'level'=>$value->level];
            $menus[$key]['submenu'] = $this->createMenus($value->son);
            if (empty($menus[$key]['submenu'])) {
                unset($menus[$key]['submenu']);
            }
        }
        if (isset($menus)) {
            return $menus;
        } else {
            return $result = ['text'=>'没有任何权限,请联系管理员'];
        }
    }

    /**
     * 获取管理员列表
     */
    public function getManagerList()
    {
        $managerList = Manager::get();
        return $managerList;
    }
    
    /**
     * 获取所有权限
     */
    public function getAccess($data = '')
    {
        static $access = [];
        foreach ($data as $key => $value) {
            $access[] = ltrim($value->menu_uri,'/');
            $this->getAccess($value->son);
            $access = array_unique($access);
        }
        if (isset($access)) {
            return $access;
        } else {
            return $access = ['text'=>'没有任何权限,请联系管理员'];
        }
    }

    /**
     * 获取用户信息通过id
     */
    public function getManagerInfoById($managerId)
    {
        return Manager::where(['manager_id'=>$managerId])->first();
    }

    /**
     * 添加用户信息
     */
    public function createManager($request)
    {
        $managerInfo = $request->input();
        if (isset($managerInfo['manager_id'])) {
            $manager = Manager::where(['manager_email'=>$managerInfo['manager_email']])->first();
        } else {
            $manager = new Manager();
        }
        $manager->manager_name = $managerInfo['manager_name'];
        $manager->manager_pwd = md5($managerInfo['manager_pwd']);
        $manager->manager_email = $managerInfo['manager_email'];
        $manager->manager_mobile = $managerInfo['manager_mobile'];
        $manager->is_super = ($managerInfo['role']==1)?1:0;
        $manager->is_freeze = 0;
        $manager->last_login_time = time();
        $manager->save();
        return $manager->manager_id;
    }

    /**
     * 给管理员分配角色
     */
    public function managerToRole($managerId,$roleId)
    {
        $manager = new Manager();
        $manager->deleteRole($managerId);
        $data = [
            'manager_id' => $managerId,
            'role_id' => $roleId,
        ];
        return $manager->toRole($data);
    }

    /**
     * 冻结用户
     */
    public function freeze($managerId)
    {
        $managerInfo = Manager::find($managerId);
        $loginId = session()->get('managerInfo')->manager_id;
        if ($loginId == $managerInfo->manager_id){
            return 0;
        } else {
            $is_freeze = $managerInfo->is_freeze?0:1;
            $result = Manager::where(['manager_id'=>$managerId])->update(['is_freeze'=>$is_freeze]);
            return $result;
        }
    }

    /**
     * 删除管理员
     */
    public function delete($managerId)
    {
        $managerInfo = Manager::find($managerId);
        $loginId = session()->get('managerInfo')->manager_id;
        if ($loginId == $managerInfo->manager_id){
            return 0;
        } else {
            $manager = new Manager();
            Manager::where(['manager_id'=>$managerId])->delete();
            $result = $manager->deleteRole($managerId);
            return $result;
        }
    }
}