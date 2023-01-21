<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGuard
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            if (in_array(Auth::id(),[2,3])) {
                Auth::logout();
                abort(401);
            }
        }

        return $next($request);
    }
}
