<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type = null;
        if (Str::contains($request->url(), 'api')) {
            $lang = $request->server('HTTP_ACCEPT_LANGUAGE') ?? 'en';
        } else {
            $lang = App::getLocale();
        }

        $custom_data = $this->data;
        return [
            'id' => $this->id,
            'title' => $custom_data['title_' . $lang],
            'body' => $custom_data['body_' . $lang],
            'image' => $custom_data['photo'] ?? null,
            'date' => $this['created_at'],
            'read_at' => $this['read_at'],

        ];
    }
}
