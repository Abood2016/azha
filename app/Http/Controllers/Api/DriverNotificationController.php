<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\CustomerNotificationResource;
use App\Http\Resources\NotificationResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverNotificationController extends Controller
{
    public function __invoke(Request $request, Driver $driver)
    {

        $page = request('page') ?? 1;
        $notifications = auth()->user()->notifications()->select('id', 'created_at', 'data', 'read_at', 'type')->orderBy('created_at', 'desc')
            ->paginate(request('perpage') ?? 10, '*', 'page', $page);
        return PaginateController::paginate($notifications, $request, NotificationResource::class);


    }
}
