<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Nếu chưa đăng nhập, chuyển về login
        }

        if (Auth::user()->is_admin) {
            return $next($request); // Nếu là admin, tiếp tục xử lý
        }

        Auth::logout(); // Nếu không phải admin, logout và chuyển về login
        return redirect()->route('login')->with('error', 'Access denied. Admins only.');
    }
}
