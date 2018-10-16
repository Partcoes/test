<?php

namespace App\Http\Middleware;

use Closure;

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
        // dd($next);
        if (!session()->has('adminUserInfo')) {
            return redirect('/warning')->with(['message'=>'请先登录','url'=>'admin/users','jumpTime'=>3,'status'=>false]);
        }
        return $next($request);
    }
}
