<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MuteNotification extends Controller
{
    public function __invoke(Request $request){
        $request->validate([
            'push_notification' => ['required', 'in:1,0']
        ]);

        auth()->user()->update([
            'push_notification' => (int) $request->push_notification
        ]);
        return response()->json([
            'status' =>  true,
            'message' =>   auth()->user()->push_notification?'Push Notification Active':'Push Notification Deactivate',
        ]);
    }
}
