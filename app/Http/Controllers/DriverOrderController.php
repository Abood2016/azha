<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\PaginateController;
use App\Models\Driver;
use App\Traits\CustomPaginate;
use Illuminate\Http\Request;

class DriverOrderController extends Controller
{
    use CustomPaginate;

    public function index(Request $request, Driver $driver)
    {
        if ($request->ajax()) {
            $orders = $this->customPaginate($driver->orders()->with(['customers', 'drivers', 'reason', 'rate', 'activities'])->get(), request('pagination')['perpage'] ?? 10, request('pagination')['page'] ?? 1);
            return PaginateController::paginate($orders, $request, 'App\Http\Resources\OrderResource');
        }
        return view('pages.driver.order.index', [
            'driver' => $driver
        ]);
    }
}
