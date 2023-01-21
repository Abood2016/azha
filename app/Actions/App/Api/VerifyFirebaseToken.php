<?php

namespace App\Actions\App\Api;

use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\Request;

class VerifyFirebaseToken
{
    public function verify()
    {
        $auth = app('firebase.auth');

        $idTokenString = request()->firebase_token;

        try {

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) {

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);
        } catch (InvalidToken $e) {

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');

        $user = $auth->getUser($uid);

        $phoneNumber = $user->phoneNumber;

        return $phoneNumber;
    }
}
