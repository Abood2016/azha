<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecruiterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
                'id' => $this->id,
            // 'orders_count' => $this->orders_count,
            'status' =>$this->status,
//            'uid' =>$this->uid,
//            'updated_at' =>$this->updated_at,
            'user' => $this->user,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
//            'user_id' =>$this->user_id,
            'created_by' => $this->created_by
        ];

    }
}
