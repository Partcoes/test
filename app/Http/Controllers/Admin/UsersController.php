<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use App\Services\Admin\RoleService;

class UsersController extends Controller
{
    //定义service变量
    protected $userService;
    protected $roleService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
    }

    /**
     * 用户登录
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'email' => 'regex:/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',
                'password' => 'required',
            ],[
                'email.regex' => '请输入正确的邮箱',
                'password.required' => '请输入密码'
            ]);
            $result = $this->userService->userLogin($request);
            return redirect('/warning')->with(['message'=>$result['message'],'url'=>$result['url'],'jumpTime'=>3,'status'=>$result['status']]);
        }
        return view('admin.users.login');
    }

    /**
     * 添加管理员
     */
    public function create()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.managercreate',['roles'=>$roles]);
    }

    /**
     * 添加管理员
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'manager_name' => 'required',
                'manager_pwd' => 'required',
                'manager_email' => 'regex:/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',
                'manager_mobile' => 'regex:/^1[0-9]{10}$/',
                'role' => 'required'
            ]);
        }
        $managerId = $this->userService->createManager($request);
        $result = $this->userService->managerToRole($managerId,$request->input('role'));
        if ($result) {
            return redirect('/warning')->with(['message'=>'保存成功','url'=>'/admin/users/list','jumpTime'=>3,'status'=>true]);
        }
    }

    /**
     * 冻结/解冻用户
     */
    public function freeze(Request $request)
    {
        $managerId = $request->input('managerId');
        return $this->userService->freeze($managerId);
    }

    /**
     * 删除用户
     */
    public function delete(Request $request)
    {
        $managerId = $request->input('managerId');
        return $this->userService->delete($managerId);
    }

    /**
     * 管理员列表
     */
    public function index()
    {
        $managerList = $this->userService->getManagerList();
        return view('admin.users.managerlist',['managerList'=>$managerList]);
    }

    /**
     * 编辑管理员信息
     */
    public function edit(Request $request)
    {
        $managerId = $request->input('manager_id');
        $default = $this->userService->getManagerInfoById($managerId);
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.managercreate',['roles'=>$roles,'default'=>$default]);
    }

    /**
     * 退出登录
     */
    public function loginout()
    {
        session()->forget('managerInfo');
        return redirect('/warning')->with(['message'=>'退出成功，欢迎使用','url'=>'/admin/login','jumpTime'=>3,'status'=>true]);
    }
}
