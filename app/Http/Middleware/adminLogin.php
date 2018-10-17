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
        $menus = $userService->getUserMenu();
        $access = $userService->getAccess();
        dump($request->getRequestUri());
        return $next($request);
    }
}
