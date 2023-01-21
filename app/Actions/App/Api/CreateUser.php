<?php

namespace App\Actions\App\Api;

use App\Actions\App\CreateUserWallet;
use App\Actions\App\CreateValidPhoneNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use QRCode;

class CreateUser
{
//    private $createUserWallet;

    public function __construct()
    {
//        $this->createUserWallet = new CreateUserWallet;
    }

    public function create(Request $request, VerifyFirebaseToken $verifyFirebaseToken)
    {
        try {
            DB::beginTransaction();

            $phoneNumber = $verifyFirebaseToken->verify();

            $user = $this->createUser($phoneNumber);

//            $user->deposit(1000);
            $token = $user->createToken($request->ip())->plainTextToken;

//            $this->createUserWallet->create($user);

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => [
                    'token' => $token,
                    'role' => $user->customer->user->role,
                    'customer' => $user->customer
                ]

            ]);
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    protected function createUser($phoneNumber): User
    {

        $createValidPhoneNumber = new CreateValidPhoneNumber;

        $user = User::create([
            'name' => $phoneNumber,
            'phone' => $createValidPhoneNumber->createPhone($phoneNumber),
            'password' => Hash::make('password'),
            'role' => 2,
            'fcm_token' => request('fcm_token'),
            'is_new' => 1
        ]);

//        $file = 'qr_code/'.time().'.png';
//        $newQrcode =  QRCode::text('{"phone":"'.$user->phone.'"}')
//            ->setSize(100)
//            ->setMargin(2)
//            ->setOutfile($file)
//            ->png();
//
//        $user->qr_code = asset($file);
//        $user->save();

        $user->customer()->create();

        return $user;
    }
}
