<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\RoleService;
use App\Services\Admin\UserService;

class RolesController extends Controller
{
    //定义service变量
    protected $roleService;
    protected $userService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->roleService = new RoleService();
        $this->userService = new UserService();
    }

    /**
     * 角色列表
     */
    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin.roles.rolelist',['roles'=>$roles]);
    }

    /**
     * 添加角色
     */
    public function create()
    {
        $menus = new \App\Services\Admin\MenuService();
        $menus = $menus->getMenus();
        return view('admin.roles.rolecreate',['menus'=>$menus]);
    }

    /**
     * 执行添加角色
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'role_name' => 'required|unique:roles,role_name',
                'menus' => 'required',
            ]);
        }
        $result = $this->roleService->createRole($request);
        if ($result) {
            return redirect('/warning')->with(['message'=>'添加成功','url'=>'/admin/roles/list','jumpTime'=>3,'status'=>true]);
        } else {
            return redirect('/warning')->with(['message'=>'添加失败','url'=>'/admin/roles/create','jumpTime'=>3,'status'=>false]);
        }
    }

    /**
     * 展示角色权限
     */
    public function show(Request $request)
    {
        $roleId = $request->input('roleId');
        $roleHasAccess = $this->roleService->getRoleAccess($roleId);
        return view('admin.roles.show',['roleHasAccess'=>$roleHasAccess]);
    }

    /**
     * 删除角色
     */
    public function delete(Request $request)
    {
        $roleId = $request->input('roleId');
        $result = $this->roleService->deleteRole($roleId);
        if ($result) {
            return redirect('/warning')->with(['message'=>'删除成功','url'=>'/admin/roles/list','jumpTime'=>3,'status'=>true]);
        } else {
            return redirect('/warning')->with(['message'=>'删除失败','url'=>'/admin/roles/list','jumpTime'=>3,'status'=>false]);
        }
    }

    /**
     * 修改角色信息
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'role_name' => 'required',
                'menus' => 'required',
            ]);
            $result =$this->roleService->createRole($request);
            if ($result) {
                return redirect('/warning')->with(['message'=>'保存成功','url'=>'/admin/roles/list','jumpTime'=>3,'status'=>true]);
            } else {
                return redirect('/warning')->with(['message'=>'保存失败','url'=>'/admin/roles/create','jumpTime'=>3,'status'=>false]);
            }
        }
        $roleId = $request->input('roleId');
        $menuService = new \App\Services\Admin\MenuService();
        $allAccess = $menuService->getMenus();
        $roleAccess = $this->roleService->getRoleAccess($roleId);
        foreach ($roleAccess as $key => $value) {
            $resourceIds[] = $value->resource_id;
        }
        $role = $this->roleService->getRoleInfoById($roleId);
        return view('admin.roles.edit',['role'=>$role,'resourceIds'=>$resourceIds,'allAccess'=>$allAccess]);
    }
}
