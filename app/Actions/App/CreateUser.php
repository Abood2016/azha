<?php

namespace App\Actions\App;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use QRCode;

class CreateUser
{
    private $createValidPhoneNumber;


    public function __construct()
    {
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
    }

    public function create($userRequest, int $role)
    {
        $user = User::create([
                'name' => $userRequest->name,
                'email' => $userRequest->email,
                'password' => Hash::make($userRequest->password),
//                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'phone' => $userRequest->phone,
                'role' => $role,
            ] + $userRequest->validated());


        if (isset($userRequest['photo'])) {
            $imageName = time() . '.' . $userRequest->photo->getClientOriginalName();
            $userRequest->file('photo')->storeAs('profile-photos', $imageName);
            $user->profile_photo_path = $imageName;
            $user->save();
        }


        return $user;
    }
}
