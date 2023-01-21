<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Business
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 4) {
            $request->merge(['place'=>true]);
            return $next($request);
        }

       return  redirect()->back();
    }
}
