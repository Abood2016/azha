<?php

namespace App\Http\Resources;

use App\Classes\Abstracts\ApiResource;
use App\Models\Order;
use App\Models\Recruiter;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $recruiter = [
            'user' => collect($this->user)->only(['phone', 'name', 'profile_photo_url']),

        ];

        $relatedServices = Service::where('category_id', $this->category_id)
            ->where('recruiter_id', $this['recruiter']['id'])->get();
            $listOfFreelancers = Order::where('service_id', $this->id)->with('customer')->get();
            $orders = Order::where('service_id', $this->id)->get();
        return [
            'id' => $this->id ? : '',
            'name' => $this->name ?: '',
            'category' => $this->category ? $this->category->name : '',
            "status" => $this->status,
            'subcategory' => $this['subcategory']['name'] ? $this['subcategory']['name'] : 'Nan',
            'recruiter' => $this['recruiter']['user']['name'] ? $this['recruiter']['user']['name'] : 'NAN',
            'recruiter_phone' => $this['recruiter']['user']['phone'] ? $this['recruiter']['user']['phone'] : 'NAN',
            'image' => $this->image_path ?? "https://picsum.photos/200/300",
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'related_service' => $relatedServices ? $relatedServices : "NAN",
            'list_freelancers' => $listOfFreelancers ? $listOfFreelancers : 'NAN',
            'count_freelancer_apply' => $listOfFreelancers->count(),
            'orders' => $orders,
            'region' => $this->region ?? 'NAN',
            'execution_time' => $this->execution_time ?? 'NAN',
            'number_person' => $this->number_person ?? 'NAN',
            'place_type' => $this->place_type ?? 'NAN',
            'photography_type' => $this->photography_type ?? 'NAN',
            'paper_type' => $this->paper_type ?? 'NAN',
            'conditioning_type' => $this->conditioning_type ?? 'NAN',
            'car_type' => $this->car_type ?? 'NAN',
            'count_photos' => $this->count_photos ?? 'NAN',
            'count_videos' => $this->count_videos ?? 'NAN',
            'polish_type' => $this->polish_type ?? 'NAN',
            'delivery_area' => $this->delivery_area ?? 'NAN',
            'residential_unit' => $this->residential_unit?? 'NAN',
            'count_workers' => $this->count_workers?? 'NAN',
            'spare_parts' => $this->spare_parts ?? 'NAN',
            'year_production' => $this->year_production ?? 'NAN',
            'message' => $this->message ?? 'NAN',
        ];
    }
}
