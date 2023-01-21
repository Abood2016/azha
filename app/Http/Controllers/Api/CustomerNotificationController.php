<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\CustomerNotificationResource;
use App\Http\Resources\NotificationResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $page = request('page') ?? 1;
        $notifications = auth()->user()->notifications()->select('id', 'created_at', 'data', 'read_at', 'type')->orderBy('created_at', 'desc')
            ->paginate(request('perpage') ?? 10, '*', 'page', $page);
        return PaginateController::paginate($notifications, $request, NotificationResource::class);
    }

    public function readAt($id)
    {
        $query = auth()->user()->unreadNotifications()->where('id', $id)->first();
        if ($query) {
            $query->markAsRead();
        }
        return response()->json([
            'status' => true
        ]);
        die();
        $notifications = collect(DB::table('notifications')->where('notifiable_id', $customer->user->id)
            ->orderBy('created_at', 'desc')->get());

        $collection = collect();

        foreach ($notifications as $notification) {

            $data = json_decode($notification->data);

            $collection->push([
                'id' => $notification->id,
                'title' => $data->title,
                'body' => $data->body,
                'image' => $data->image,
                'date' => $notification->created_at,
                'read_at' => $notification->read_at
            ]);
        }

        return new CustomerNotificationResource($collection->paginate($request->perpage ?? 10));
    }
}
