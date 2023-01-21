<?php

namespace App\Traits;

use App\Http\Controllers\Helper\PaginateController;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

trait GetOrderData
{

    public function orders($request,$resource = 'App\Http\Resources\OrderResource'){
        $sort_field  = request('sort')['field']??'id';
        $sort_type  = request('sort')['sort']??'desc';
        $page = request('pagination')['page']??1;

        if(in_array(Auth::user()->role,[0,1])){ //for super and sub admin get all orders (system)
            $orders = Order::with(['customers','drivers'])->where('created_by','!=','business');
        }else //for business admin get orders
            $orders = Order::with(['business_customers','drivers','activities']);
        $orders = clone $orders;
        $orders = $orders
            ->when(isset(request('query')['status']) || session('canceled_order'), function ($q)  {
                if(isset(request('query')['status']))
                    return   $q->where('status',request('query')['status']);
                else
                    return   $q->whereIn('status',[Order::$cancelByDriver,Order::$cancelByAdmin,Order::$cancelByCustomer]);
            }) ->when(isset(request('query')['driver_id']), function ($q)  {
                return   $q->whereHas('drivers',function ($q) {
                    $q->where('drivers.id', '=', request('query')['driver_id']);
                });
            })->when(isset(request('query')['customer_id']), function ($q)  {
                return   $q->whereHas('customers',function ($q) {
                    $q->where('customers.id', '=', request('query')['customer_id']);
                });
            })->when(isset(request('query')['business_customer_id']), function ($q)  {
                return   $q->whereHas('business_customers',function ($q) {
                    $q->where('business_customers.id', '=', request('query')['business_customer_id']);
                });
            })->orderby($sort_field,$sort_type)->paginate(request('pagination')['perpage']??10,'*','page',$page);
        return PaginateController::paginate($orders,$request,$resource);


    }


}
