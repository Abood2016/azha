<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\Api\UpdateFirestore;
use App\Http\Controllers\Controller;
use App\Jobs\DeleteOrderFirestore;
use App\Models\Order;
use App\Models\Reason;
use App\Notifications\CancelOrderByDriverToCustomer;
use App\Traits\CreateActivityOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Firestore;

class DriverCancelOrderController extends Controller
{
    use CreateActivityOrder;

    private $updateFirestore;
    private $request;
    private $firestore;
    private $count_active_orders;


    public function __construct(UpdateFirestore $updateFirestore, Firestore $firestore, Request $request)
    {
        $this->updateFirestore = $updateFirestore;
        $this->firestore = $firestore;
        $this->request = $request;
    }

    public function __invoke(Order $order)
    {
        $this->count_active_orders = $this->firestore->database()->collection(config('global.collection_drivers'))->document($order->drivers[0]->id)->snapshot()->data()['count_active_orders'];;
        return $this->cancel($order);
    }

    public function cancel($order, Firestore $firestore)
    {
        DB::beginTransaction();
        if (count($order->drivers) != 0) {
            $this->updatedDriver($order);
            $this->updateFirestoreDriver($order);
        }

        $this->updateOrder($order);

        $this->updateFirestoreOrder($order);

        $this->associateWithReason($order);
        DB::commit();

        // update status in firestore
        $database = $firestore->database();
        $database->collection(config('global.collection_orders'))->document($order->data()['id'])->update([
            ['path' => 'reason', 'value' => 'canceled']
        ]);

        Notification::send($order->customers[0]->user, new CancelOrderByDriverToCustomer($order->id));



        return response()->json([
            'status' => true,
            'messages' => 'Order has been canceled'
        ]);
    }

    protected function updatedDriver($order)
    {
        if ($this->count_active_orders < 4) {
            $order->drivers[0]->update([
                'available' => 1
            ]);
        }

    }

    protected function updateFirestoreDriver($order)
    {
        $data = [
            ['path' => 'suggested_order_id', 'value' => null],
            ['path' => 'count_active_orders', 'value' => ($this->count_active_orders - 3)]
        ];
        if ($this->count_active_orders < 4) {
            array_push($data, ['path' => 'available', 'value' => 1]);

        }
        $this->updateFirestore->update(config('global.collection_drivers'), $order->drivers[0]->id, $data);
    }

    protected function updateOrder($order)
    {
        $order->update([
            'status' => Order::$cancelByDriver,
            'canceled_at' => now()
        ]);
        $this->createActivity($order->id, Order::$cancelByDriver);

    }

}
