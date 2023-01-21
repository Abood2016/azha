<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GetIndexData;
use Illuminate\Http\Request;

class GetCustomerOrdersController extends Controller
{
    use GetIndexData;

    public function __invoke(Customer $customer)
    {
        return $this->data($customer->load('orders')->orders(), false);
    }
}