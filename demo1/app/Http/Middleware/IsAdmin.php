<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // A => MW => B
        // auth() trả về object xác thực quyền
        // auth()->user() trả ra object là user đang đăng nhập
        // auth()->user()->is_admin == 1 là quyền admin
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }

        return redirect('home')->with('error',"You don't have admin access.");
    }
}
