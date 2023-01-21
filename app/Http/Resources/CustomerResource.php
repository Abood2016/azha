<?php

namespace App\Http\Resources;

use App\Classes\Abstracts\ApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'orders_count' => $this->orders()->count(),
            'status' =>$this->status,
            'user' =>$this->user,
            'user_id' =>$this->user_id,
            'user_name' =>$this->user->name,
            'age' =>$this->age,
            'address' =>$this->address,
        ];
    }
}
