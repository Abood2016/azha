<?php

namespace App\Classes\Interfaces;

interface ApiResourceInterface
{
    public function toArray($request);

    public function withResponse($request, $response);

    public function with($request);
}