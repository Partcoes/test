<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Admin\UserService;

class adminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('managerInfo')) {
            return redirect('/warning')->with(['message'=>'请先登录','url'=>'admin/login','jumpTime'=>3,'status'=>false]);
        }

        //获取用户权限
        $userService = new UserService();
        $data = $userService->getUserAccess();
        $access = $userService->getAccess($data);
        if (ltrim($request->getPathInfo(),'/') != 'admin') {
            if (!in_array(ltrim($request->getPathInfo(),'/'),$access)) {
                return redirect('/warning')->with(['message'=>'没有此权限，请联系管理员','url'=>'admin/users/list','jumpTime'=>3,'status'=>false]);
            }
        }
        return $next($request);
    }
}
