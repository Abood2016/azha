<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => 'nullable',
            'email' => 'nullable',
            'twitter' => 'nullable',
            'snapchat' => 'nullable',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->messages()
            ]);
        }

        $user = auth()->user();
        $user->update($validator->validated());
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('profile-photos', $fileName);
            $user->profile_photo_path = $fileName;
            $user->save();
        }
        return response()->json([
            'status' => true,
            'data' => auth()->user()
        ]);
    }
    public function profile(){
        return response()->json([
            'status' => true,
            'data' => auth()->user()
        ]);
    }
}
