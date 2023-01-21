<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
//        $data = $request->validate([
//            'user_id' => ['required', 'exists:users,id']
//        ]);

//        $user = User::findOrFail($data['user_id']);
        auth()->user()->update([
            'fcm_token' => null
        ]);
        auth()->user()->tokens()->delete();


        return response()->json([
            'status' => true,
            'message' => 'Logout successfully'
        ]);
    }
}
