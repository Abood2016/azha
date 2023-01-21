<?php

namespace App\Http\Controllers;

use App\Actions\App\Api\GetDistance;
use App\Actions\App\CreateOrder;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\AdminOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Recruiter;
use App\Models\Service;
use App\Models\Type;
use App\Traits\GetOrderData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Firestore;

class OrderController extends Controller
{

    private $service;
    private $driver;
    private $customer;
    private $type;
    private $recruiter;
    use GetOrderData;

    public function __construct()
    {
        $this->middleware(['permission:orders-create'], ['only' => ['store', 'create']]);
        $this->middleware(['permission:orders-read'], ['only' => ['index']]);
        $this->middleware(['permission:orders-update'], ['only' => ['update', 'edit']]);
        $this->service = Service::all()->first();
        $this->driver = Driver::query();
        $this->customer = Customer::query();
        $this->type = Type::query();
        $this->recruiter = Recruiter::query();
    }

    public function index(Request $request)
    {
        if (!$request->ajax() && $request->canceled_order) {
            session(['canceled_order' => true]);
        } elseif (!$request->ajax() && !$request->canceled_order) {
            session(['canceled_order' => false]);
        }

        if ($request->ajax()) {
            if ($request['query']) {
                if (isset($request['query']['driver_id']) || isset($request['query']['customer_id']) || $request['query']['status'])
                    session(['canceled_order' => false]);
            }
            return $this->orders($request);
        }

        return view('pages.order.index', [
            'page_title' => 'الطلبات',
            'drivers' => $this->driver->get(),
            'recruiter' => $this->recruiter->get(),
            'customers' => $this->customer->get(),
        ]);
    }

    public function create()
    {
        $customers = DB::table('users')
            ->join('customers', 'users.id', '=', 'customers.user_id')
            ->where('status', 1)
            ->select('customers.id', 'users.name')
            ->get();
        $drivers = DB::table('users')
            ->join('drivers', 'users.id', '=', 'drivers.user_id')
            ->where('available', 1)->where('approve', 1)->where('available', 1)->where('status', 1)
            ->select('drivers.id', 'users.name')
            ->get();
        return view('pages.order.create', [
            'page_title' => 'Create Order',
            'customers' => $customers,
            'places' => $this->place->where('active', 1)->select('id', 'name', 'place_id')->get(),
            'drivers' => $drivers,
            'types' => $this->type->where('active', 1)->select('id', 'key', 'name')->get()
        ]);
    }

    public function store(AdminOrderRequest $adminOrderRequest, CreateOrder $createOrder, Firestore $firestore)
    {
        return $createOrder->create($adminOrderRequest, $firestore);
    }

    public function show(Order $order, Firestore $firestore, GetDistance $getDistance)
    {
        $order = (new OrderResource($order))->resolve();
        $drivers = \App\Actions\App\GetNearestDrivers::getNearestDrivers($getDistance, $firestore, $order);
        $drivers = Driver::with('user')->whereIn('id', $drivers->pluck('driver_id')->toArray())->get();

        $data = [
            'order' => $order,
        ];

//        if ($order['status'] == Order::$notFoundFirstTime || $order['status'] == Order::$notFoundTryAgain) {
        if ($order['status'] == Order::$notFoundTryAgain) {
            $drivers = \App\Actions\App\GetNearestDrivers::getNearestDrivers($getDistance, $firestore, $order);
            $drivers = Driver::with('user')->whereIn('id', $drivers->pluck('driver_id')->toArray())->get();
            $data += ['available_drivers' => $drivers];
        }

        return view('pages.order.show', $data);
    }

    public function uploadRecord(Request $request)
    {
        dd($request->all());
        $request->file('Blob')->storeAs('record_voice', "test");;
    }

}
