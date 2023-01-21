<?php

namespace App\Http\Resources;

use App\Classes\Abstracts\ApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'approve' =>$this->approve,
            'available' =>$this->available,
            'connection' =>$this->connection,
            'coordinates' =>$this->coordinates,
            'created_at' =>$this->created_at,
            'created_by' =>$this->created_by,
            'distance' =>$this->distance,
            'id' =>$this->id,
            'orders_count' => $this->orders_count,
            'licence_expire_date' =>$this->licence_expire_date,
            'licence_number' =>$this->licence_number,
            'times_rated' => $this->timesRated(),
            'rate' =>intval($this->averageRating),
            'status' =>$this->status,
            'trips_count' =>$this->trips_count,
            'uid' =>$this->uid,
            'updated_at' =>$this->updated_at,
            'user' =>$this->user,
            'user_id' =>$this->user_id,
            'user_name' =>$this->user->name,
            'vehicle_brand' =>$this->vehicle_brand,
            'vehicle_color' =>$this->vehicle_color,
            'vehicle_model' =>$this->vehicle_model,
            'vehicle_name' =>$this->vehicle_name,
            'vehicle_purchase_year' =>$this->vehicle_purchase_year,
            'vehicle_registration_number' =>$this->vehicle_registration_number,
            'revenue' =>$this->getRevenue(),
            'commissions' =>number_format($this->getCommissions(),'2'),
        ];
    }
}
