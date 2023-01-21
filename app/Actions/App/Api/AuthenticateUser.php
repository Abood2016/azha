<?php

namespace App\Actions\App\Api;

use App\Jobs\test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use QRCode;

class AuthenticateUser
{
    public function authenticate(Request $request, CreateUser $createUser, VerifyFirebaseToken $verifyFirebaseToken)
    {

//
//        ///------------------------------test//--------------------------
////
//        Queue::later(Carbon::now()->minutes(30),new test());
//
//        $user = User::find($request->id);
//        $token = $user->createToken($request->ip())->plainTextToken;
//        return response()->json([
//            'status' => true,
//            'data' => [
//                'token' => $token
//            ],
//        ]);
//
//        die();
        //------------------------------
        $phoneNumber = $verifyFirebaseToken->verify();
        $user = User::where('phone', $phoneNumber)->first();

        if (!$user) {
            if (!$request->is_customer)
                return response()->json([
                    'status' => false,
                    'message' => 'This App for driver, You must create account from admin'
                ]);
            return $createUser->create($request, $verifyFirebaseToken);
        }

        $user->update(
            ['fcm_token' => $request->fcm_token, 'random_number' => rand(1, 1000000) . ""]
        );

        if ($user->role == 3) {
            $user->driver->update([
                'uid' => $request->uid
            ]);
            $setToFirestore = new SetToFirestore();
            $setToFirestore->set(config('global.collection_drivers'), $user->driver->id, $user->driver->toArray() + ['count_active_orders' => 0, 'suggested_order_id' => null]);
        }

        $token = $user->createToken($request->ip())->plainTextToken;

        $data = $this->getUserRelation($user, $token);

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    protected function getUserRelation($user, $token)
    {

        return $user->role === 2 ?
            [
                'token' => $token,
                'role' => $user->customer->user->role,
                'customer' => collect($user->customer)->put('wallet_balance', 10),
            ] :
            [
                'token' => $token,
                'role' => $user->driver->user->role,
                'driver' => collect($user->driver)->put('wallet_balance', 10),
            ];
    }
}
