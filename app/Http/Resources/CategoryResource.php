<?php

namespace App\Http\Resources;

use App\Classes\Abstracts\ApiResource;
use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        $getCount = null;

        $getCount = Service::where('category_id' , $this->id)->get();


        return [
            "id" => $this->id,
            "name" => $this->name,
            "active" => $this->active,
            "image_path" => $this->image_path,
//            'count_recruiter' => count($getCount),
        ];
    }

}
