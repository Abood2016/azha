<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\App\Api\VerifyFirebaseToken;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateFcmController extends Controller
{
    public function __invoke(Request $request, VerifyFirebaseToken $verifyFirebaseToken)
    {

        $phoneNumber = $verifyFirebaseToken->verify();

        $user = User::where('phone', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        $user->update([
            'fcm_toke' => $request->fcm_token
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Fcm token has been updated'
        ]);
    }
}
