<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class MarkNotificationAsRead extends Controller
{
    public function __invoke($notification_id)
    {
        try {
//            return auth()->user();
            auth()->user()->unreadNotifications->where('id', $notification_id)->first()->markAsRead();

            return response()->json([
                'status' => true,
                'message' => 'Notification has been mark as read'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => 'Notification is already read'
            ]);
        }
    }
}
