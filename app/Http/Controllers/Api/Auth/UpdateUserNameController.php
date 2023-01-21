<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateUserNameController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->messages()
            ]);
        }
        $user = auth()->user();
        $user->update( $validator->validated()+[
            'is_new' => 0
        ]);
        if($request->hasFile('image')){
            $fileName = time().'.'.$request->image->extension();
            $request->file('image')->storeAs('profile-photos', $fileName);
            $user->profile_photo_path = $fileName;
            $user->save();
        }
        return response()->json([
            'status' => true,
            'data' => auth()->user()
        ]);
    }
}
