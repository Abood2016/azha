<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderStatusConroller extends Controller
{
    public function __invoke(Request $request)
    {
        App::setLocale($request->server('HTTP_ACCEPT_LANGUAGE') ?? 'en');
        $data = [
            [
                'title' => __('lang.All'),
                'value' => null,
            ],
            [
                'title' => __('lang.Accepted'),
                'value' => Order::$accept,
            ],
            [
                'title' => __('lang.Cancel'),
                'value' => Order::$cancelByCustomer,
            ],
            [
                'title' => __('lang.Completed'),
                'value' => Order::$complete,
            ],

        ];
        if(auth()->user()->role ==2){
            array_push($data,
                [
                    'title' => __('lang.Pending'),
                    'value' => Order::$pending,
                ]);
        }
        return response()->json([
            'status' => true,
            'data' => $data]);
    }
}
