<?php

namespace App\Actions\App;

use App\Models\User;

class UpdateUser
{
    private $createValidPhoneNumber;

    public function __construct()
    {
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
    }

    public function update($userRequest, User $user)
    {
        $user->update([
            'phone' => $this->createValidPhoneNumber->createPhone($userRequest->validated()['phone']),
        ] + $userRequest->validated());

        if (isset($userRequest['photo'])) {
            $user->updateProfilePhoto($userRequest['photo']);
        }

        return $user;
    }
}
