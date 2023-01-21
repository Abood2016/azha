<?php

namespace App\Classes\Abstracts;

use App\Classes\Interfaces\ApiResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\PaginationMeta;

abstract class ApiResource extends JsonResource implements ApiResourceInterface
{
    use PaginationMeta;

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function withResponse($request, $response)
    {
        return $this->unset($response);
    }

    public function with($request)
    {
        return [
            'status' => true,
            'meta' => $this->set(),
        ];
    }
}