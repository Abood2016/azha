<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminGuard
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            return $next($request);
        }
        return redirect()->back();
    }
}
