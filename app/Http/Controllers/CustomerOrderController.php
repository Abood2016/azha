<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\PaginateController;
use App\Models\Customer;
use App\Traits\CustomPaginate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CustomerOrderController extends Controller
{
    use CustomPaginate;
    public function index(Request $request ,Customer $customer){
        if($request->ajax()){
            $orders = $this->customPaginate($customer->orders()->with(['customers','drivers','reason','rate','activities'])->get(),request('pagination')['perpage']??10,request('pagination')['page']??1);
            return PaginateController::paginate($orders,$request,'App\Http\Resources\OrderResource');
        }
        return view('pages.customer.order.index',[
            'customer' => $customer
        ]);
    }

}
