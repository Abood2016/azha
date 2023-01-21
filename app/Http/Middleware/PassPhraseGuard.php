<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassPhraseGuard
{

    // if the user's session contains a passphrase then we need to direct the user to the 
    // passphrase confirm route instead.
    // need to allow the user through to any login routes

    public function handle(Request $request, Closure $next)
    {
        $passphrase = auth()->user()->passphrase ?? null;

        if (is_null($passphrase)) {
            return $next($request);
        }

        // passphrase set, still valid?

        if (auth()->user()->passphrase_expiry < now()->timestamp) {
            
            auth()->user()->resetVerificationCode();

            Auth::user()->tokens()->delete();

            return response()->json([
                'status' => true,
                'data' => [
                    'user' => auth()->user()
                ],
            ]);
        }

        if ($request->route()->named('authentication.*')) {
            return $next($request);
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Your not verified'
        ]);
    }
}
