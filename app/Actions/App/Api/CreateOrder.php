<?php

namespace App\Actions\App\Api;

use App\Actions\App\CalculateOrderCharge;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\GetNearestDrivers;
use App\Models\ActivityOrder;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\Place;
use App\Models\Recruiter;
use App\Models\Service;
use App\Models\SettingOrder;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Traits\CreateActivityOrder;
use Gabievi\Promocodes\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Doctrine\DBAL\Query;


class CreateOrder
{
    use CreateActivityOrder;


    public function create(CreateOrderRequest $createOrderRequest)
    {
        $error = false;



        try {

            $service = Service::find($createOrderRequest->service_id);

            $customer = Customer::active()->findOrFail(auth()->user()->customer->id);

            $getIdCustomer = $customer->id;


            if ($service && $customer && auth()->user()->customer->id == auth()->user()->customer->id) {

                DB::beginTransaction();

                $data = [
                    'service_id' => $createOrderRequest->service_id,
                    'customer_id' => $getIdCustomer,
                    'status' => Order::$pending,
                    'created_by' => 'customer',
                    'message' => $createOrderRequest->message,
                    'recruiter_id' => $service->recruiter_id,
                ];


                if(Order::where('customer_id', $getIdCustomer)->where('service_id', $createOrderRequest->service_id)->exists()){


                    return returnError(404, 'You are Already Apply For This Service ');

                }else{


                    $getRecruiter = Recruiter::where('id' , $service->recruiter_id)->first();
                    $getUserId = $getRecruiter->user_id;
                    $user = User::where('id' , $getUserId)->first();
                    Notification::send($user , new NewOrderNotification($service));

                    $order = Order::create($data + ['uuid' => Str::uuid()]);

                    $customer->orders()->attach($order->id);

                    $order['image'] = $service->image_path;

                    DB::commit();


                    return response()->json([
                        'status' => true,
                        'data' => $order
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
