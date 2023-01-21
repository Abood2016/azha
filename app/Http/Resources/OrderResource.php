<?php

namespace App\Http\Resources;

use App\Actions\App\Api\GetDistance;
use App\Models\Location;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {


        return [

            'id' => $this->id,
            'status' => $this->status,
            'customer' => $this['customer']  ?  $this['customer']['user']['name'] : 'NAN',
            'image_path' => $this->service->image_path,
            'service_id' => $this->service->id,
            'recruiter' => $this->service->recruiter_id,
            'name_service' => $this['service']['name'] ?: 'nan',
            'service_details' => $this['service'],
            'message' => $this->message
        ];

    }
}
