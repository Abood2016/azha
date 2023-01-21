<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveUser
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
        $message = 'Not Allow';
        $data = [
            'status' => 'your account blocked',
        ];
        if(auth()->user()->role == 0)
            return $next($request);
        elseif(auth()->user()->recruiter){
            if(auth()->user()->recruiter->status == 1){
                return $next($request);
            }elseif (auth()->user()->recruiter->status == 0){
                return response()->json([
                    'status' =>false,
                    'blocked_data' =>$data,
                ],203);
            }
        }
        elseif(auth()->user()->customer && auth()->user()->customer->status == 1)
            return $next($request);
        $data +=['message' => $message];
        return response()->json([
            'status' =>false,
            'blocked_data' =>$data,
        ],203);
    }
}
