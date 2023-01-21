<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Jobs\CollectingPlaces;
use App\Jobs\test;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;
use willvincent\Rateable\Rating;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $drivers = Driver::query();
        $orders = Order::query();
        $last_online_drivers = Driver::with('user')->where('connection',1)->orderByDesc('updated_at')->limit(5)->get();
        $last_offline_drivers = Driver::with('user')->where('connection',0)->orderByDesc('updated_at')->limit(5)->get();
        $last_cancel_orders = OrderResource::collection(Order::whereIn('status', [Order::$cancelByCustomer,Order::$cancelByAdmin,Order::$cancelByDriver])->orderByDesc('created_at')->limit(5)->get());
        $last_orders = OrderResource::collection(Order::orderByDesc('created_at')->limit(5)->get());

        return view('pages.dashboard', [
            'page_title' => 'Dashboard',
            'orders_count' => $orders->count(),

            'services_count' => Service::count(),
            'customers_count' => Customer::count(),
            'drivers_count' => $drivers->count(),
//            'ratings_count' => Rating::count(),
            'canceled_orders_count' => $orders->whereIn('status', [Order::$cancelByCustomer,Order::$cancelByAdmin,Order::$cancelByDriver])->count(),
            'last_cancel_orders' => $last_cancel_orders->resolve(),
            'last_online_drivers' => $last_online_drivers,
            'last_offline_drivers' => $last_offline_drivers,
            'last_orders' => $last_orders->resolve(),
            'offline_drivers_count' => $drivers->where('connection', 0)->where('approve', 1)->where('status', 1)->count(),
        ]);
    }
}
