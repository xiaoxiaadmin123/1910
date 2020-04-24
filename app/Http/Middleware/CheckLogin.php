<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
    //    dd(encrypt('123456'));
        // 判断用户是否登录
        $adminuser = session('adminuser');
        // dd($adminuser);
        if(!$adminuser){
            return redirect('/login');
        }
        return $next($request);
    }
}
