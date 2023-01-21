<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\Api\CreateOrder;
use App\Actions\App\Api\UpdateFirestore;
use App\Actions\App\ChangeStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\CreateAgainOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\DeleteOrderFirestore;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use App\Traits\CreateActivityOrder;
use App\Traits\GetIndexData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Firestore;

class OrderController extends Controller
{
    use GetIndexData, CreateActivityOrder;

    public function index(Request $request)
    {
        $type_user = auth()->user()->role == 2 ? 'customer' : 'driver';
        $getCustomer = Customer::where('user_id' , auth()->user()->id)->first();

        $cancel = [2, 5, 6];
        $orders = Order::where('customer_id' , $getCustomer->id)->with(['customers', 'service'])->whereNotIn('status', [3, 4])
            ->when(isset($request->done) , function ($q) use ($request){
                    // $service = Service::find($order->id);
                    // $dayAgo = $service->execution_time;
                    // $dayToCheck = Carbon::now()->subDays(5);
                    return $q->where('created_at',Carbon::now()->subDays(5));
            })
            ->when(isset($request->status) && $request->status != 'null', function ($q) use ($request, $cancel) {

                if ($request->status == 2) {
                    return $q->whereIn('status', $cancel);
                }



                return $q->where('status', $request->status);
            })->orderBy('created_at', 'desc')->paginate($request->perpage ?? 10);
        return PaginateController::paginate($orders, null, 'App\Http\Resources\OrderResource');
    }

    public function show(Order $order)
    {
        return response()->json([
            'status' => true,
            'data' => new OrderResource($order)
        ]);
    }

    public function create(CreateOrderRequest $createOrderRequest, CreateOrder $createOrder)
    {
        return $createOrder->create($createOrderRequest);
    }



    public function update(Request $request, UpdateFirestore $updateFirestore,Firestore $firestore)
    {
        $order = Order::find($request->id);
        $order->update(['status' => Order::$cancelByAdmin, 'canceled_at' => now()]);
        $this->createActivity($order->id, Order::$cancelByAdmin);
        $updateFirestore->update(config('global.collection_orders'), $order->id, [
            ['path' => 'status', 'value' => Order::$cancelByAdmin]
        ]);
        $updateFirestore->update(config('global.collection_orders'), $order->id, [
            ['path' => 'status', 'value' => Order::$cancelByAdmin]
        ]);
        $suggested_driver = $firestore->database()->collection(config('global.collection_orders'))->document( $order->id)->snapshot()->data()['suggested_driver'];
        $updateFirestore->update(config('global.collection_drivers'), $suggested_driver, [
            ['path' => 'suggested_order_id', 'value' =>  null],
        ]);
        DeleteOrderFirestore::dispatch($order->id);
    }
}
