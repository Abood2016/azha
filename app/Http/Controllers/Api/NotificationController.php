<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $page = request('page') ?? 1;
        $notifications = auth()->user()->notifications()->select('id', 'created_at', 'data', 'read_at', 'type')->orderBy('created_at', 'desc')
            ->paginate(request('perpage') ?? 10, '*', 'page', $page);

        return PaginateController::paginate($notifications, $request, null, true);
    }
}
