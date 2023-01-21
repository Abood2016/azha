<?php

namespace App\Traits;

use App\Models\ActivityOrder;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

trait CreateActivityOrder
{
    public function createActivity($order_id, $status, $picked_at = null)
    {
        $data = [
            'status' => $status,
            'order_id' => $order_id,
        ];
        if (!is_null($picked_at)) {
            $data += [
                'created_at' => $picked_at, // for picked at after complete
            ];
        }
        ActivityOrder::create($data);
    }
}
