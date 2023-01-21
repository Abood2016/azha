<?php

namespace App\Classes\Abstracts;

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Service;

abstract class Order
{
    private $service;
    private $driver;
    private $customer;

    public function __construct()
    {
        $this->service = Service::query();
        $this->driver = Driver::query();
        $this->customer = Customer::query();
    }

    public function service()
    {
        return $this->service;
    }

    public function driver()
    {
        return $this->driver;
    }

    public function customer()
    {
        return $this->customer;
    }
}